<?php


namespace Unit\Services;

use \UnitTester;
use app\models\Tender;
use app\services\TenderService;
use Codeception\Test\Unit;
use yii\httpclient\Client;

class TenderServiceTest extends \Codeception\Test\Unit
{

    public function testUpdateTable()
    {
        $tenderService = new TenderService();

        $startUrl = "https://public.api.openprocurement.org/api/0/tenders?descending=1";

        $mockClient = $this->getMockBuilder(\yii\httpclient\Client::class)
            ->onlyMethods(['createRequest'])
            ->getMock();

        $mockRequest = $this->getMockBuilder(\yii\httpclient\Request::class)
            ->onlyMethods(['setUrl', 'send'])
            ->getMock();

        $mockResponse = $this->getMockBuilder(\yii\httpclient\Response::class)
            ->onlyMethods(['getData'])
            ->getMock();

        $mockRequest->expects($this->exactly(10))
            ->method('setUrl')
            ->willReturnSelf();

        $mockClient->expects($this->exactly(10))
            ->method('createRequest')
            ->willReturn($mockRequest);

        $mockRequest->expects($this->exactly(10))
            ->method('send')
            ->willReturn($mockResponse);

        $mockResponse->expects($this->exactly(10))
            ->method('getData')
            ->willReturn(['next_page' => ['uri' => 'next_page'], 'data' => []]);

        $tenderService->client = $mockClient;

        $result = $tenderService->update_table();

        $this->assertTrue($result);
    }
}
