<?php
use yii\grid\GridView;

$this->title = 'Таблиця тендерів';
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'tenderID',
        'description',
        'amount',
        'dateModified',
    ],
]);
