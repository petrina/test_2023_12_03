<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tenders".
 *
 * @property int $table_id
 * @property string $id
 * @property string $tenderID
 * @property string|null $description
 * @property float|null $amount
 * @property string|null $dateModified
 */
class Tender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tenders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tenderID'], 'required'],
            [['description'], 'string'],
            [['amount'], 'number'],
            [['dateModified'], 'safe'],
            [['id', 'tenderID'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'table_id' => 'Table ID',
            'id' => 'ID',
            'tenderID' => 'Tender ID',
            'description' => 'Description',
            'amount' => 'Amount',
            'dateModified' => 'Date Modified',
        ];
    }
}
