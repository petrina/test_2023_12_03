<?php


namespace app\commands;

use yii\console\Controller;
use yii\httpclient\Client;
use app\services\TenderService;

class SyncConsoleController extends Controller
{
    public function actionIndex()
    {
        $table = new TenderService();

        if ($table->update_table()) {
            echo "Updated!\n";
        } else {
            echo "Error script. \n";
        }

    }
}
