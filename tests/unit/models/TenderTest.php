<?php


namespace Unit\models;

use \UnitTester;
use app\models\Tender;

class TenderTest extends \Codeception\Test\Unit
{

    public function testValidation()
    {
        $model = new Tender();

        $model->id = null;
        $model->tenderID = null;
        $this->assertFalse($model->validate());

        $model->id = 'test_id';
        $model->tenderID = 'test_tender_id';
        $this->assertTrue($model->validate());

        $model->amount = 'not_a_number';
        $this->assertFalse($model->validate());

        $model->amount = 123.45;
        $this->assertTrue($model->validate());
    }

    public function testSave()
    {
        $model = new Tender();

        $model->id = 'test_id';
        $model->tenderID = 'test_tender_id';
        $model->amount = 123.45;

        $this->assertTrue($model->save());

        $savedModel = Tender::findOne(['id' => 'test_id']);
        $this->assertNotNull($savedModel);
        $this->assertEquals('test_tender_id', $savedModel->tenderID);
        $this->assertEquals(123.45, $savedModel->amount);
    }
}
