<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add new product', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Load new products info', ['load', 'mode' => 'new'], ['class' => 'btn btn-info pull-right load-new-btn']) ?>
        <?= Html::a('Load all products info', ['load'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'asin',
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($data){
                    return (!empty($data->url))
                        ? Html::a($data->title, $data->url, ['target' => '_blank'])
                        : $data->title;
                }
            ],
            'formatted_price',
             [
                 'attribute' => 'picture',
                 'filter' => false,
                 'format' => 'html',
                 'value' => function($data){
                    return (!empty($data->picture)) ? Html::img($data->picture, ['style' => 'max-width: 100px;']) : '';
                 }
             ],
             'ean',
             'brand',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>