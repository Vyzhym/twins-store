<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\File */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Хранилище файлов';
$this->params['breadcrumbs'][] = $this->title;
function is_image($filename) {
    $is = @getimagesize(Yii::getAlias("@frontend").'/web/images/'.$filename);
    if ( !$is ) return false;
    elseif ( !in_array($is[2], array(1,2,3)) ) return false;
    else return true;
}
?>
<div class="file-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'file',
            [
                'attribute' => "file",
                'value' => function($model){

                    $html = '';
                    if(is_image($model->file)){
                        if(!empty($model->file)) {
                            $html .= "<img width='100' src='/images/{$model->file}' alt='' style='max-width: 100%'>";
                        }
                    }else{
                        $html .= "<a download href='/images/{$model->file}'>{$model->file}</a>";
                    }

                    return $html;
                },
                'format' => 'html'
            ],
            [
                'attribute' => "title",
                'value' => function($model){
                    $val = '';
                    foreach ($model->title as $lang=>$msg){
                        $val .= "[{$lang}] ".$msg."<br>";
                    }
                    return $val;
                },
                'format' => 'html'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
