<?php

namespace app\services;

use yii\httpclient\Client;
use app\models\Tender;
use app\models\Log;

class TenderService
{
    public function update_table() {
        $startUrl = "https://public.api.openprocurement.org/api/0/tenders?descending=1";

        for ($i = 0; $i < 10; $i++) {
            $response = $this->get_response($startUrl);

            if ($response->isOk) {
                $data = $response->data;
                $startUrl = $data['next_page']['uri'];
                $this->get_tender_info($data['data']);

            } else {
                // Обробка помилки
                echo "HTTP-статус: " . $response->statusCode;
            }
        }
        return true;
    }

    private function get_response($url) {
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->send();
        return $response;
    }

    private function get_tender_info($data) {
        $log = new Log();
        foreach ($data as $tender) {

            $tenderUrl = "https://public.api.openprocurement.org/api/0/tenders/" . $tender['id'];

            $responseTender = $this->get_response($tenderUrl);
            if ($responseTender->isOk) {
                $tenderData = json_decode($responseTender->content)->data;
                print_r($tenderData);

                $tenderId = $tenderData->tenderID;
                $isExist = Tender::find()->where(['tenderID' => $tenderId])->one();

                    if (!$isExist) {
                        $tenderInfo = [
                            'id' => $tenderData->id,
                            'tenderID' => $tenderId,
                            'description' => isset($tenderData->description) ? $tenderData->description : '',
                            'amount' => isset($tenderData->value->amount) ? $tenderData->value->amount : $tenderData->awards[0]->value->amount,
                            'dateModified' => $tenderData->dateModified,
                        ];

                        $tenderModel = new Tender($tenderInfo);

                        if (!$tenderModel->save()) {
                            $errors = $tenderModel->errors;
                            $log->error = $errors;
                            $log->save();
                            echo 'ERROR';
                        }
                    }

            } else {
                $log->code = $responseTender->statusCode;
                $log->save();
                echo "HTTP-статус: " . $responseTender->statusCode;
            }
        }
    }

}