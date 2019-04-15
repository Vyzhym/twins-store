<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\File */
/* @var $form yii\widgets\ActiveForm */

function is_image($filename) {
    $is = @getimagesize(Yii::getAlias("@frontend").'/web/images/'.$filename);
    if ( !$is ) return false;
    elseif ( !in_array($is[2], array(1,2,3)) ) return false;
  else return true;
}
?>
<?php
$fieldCode="Title";
$fields = "";
foreach (Yii::$app->params['languages'] as $lang){
    $pref = $lang['url'];
    $field = $fieldCode."[".$lang['url']."]";
    $value = (isset($model->title[$pref])) ? $model->title[$pref] : "";
    $col_md = "col-md-".(int)(12/count(Yii::$app->params['languages']));
    $fields .= '
<div class="form-group field-message-message has-success '.$col_md.'">
    <label class="control-label" for="message-message">'.$field.'</label>
    <textarea id="message-message" class="form-control" name="'.$field.'" maxlength="255" rows="6" aria-invalid="false">'.$value.'</textarea>
</div>';
}
?>

<div class="file-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
        <?php
        $html = "<div style='border:2px solid #000; padding:5px;margin-top:5px;margin-bottom:5px'>";
        if($model->file != ''){
            if(is_image($model->file)){
                if(!empty($model->file)) {
                    $html .= "<img src='/images/{$model->file}' alt='' style='max-width: 100%'><br>";
                    $html .= "<a href='" . \yii\helpers\Url::to(["file/delimage", 'img' => base64_encode(implode("|", [$model->file, $model->id, 1]))]) . "'>Удалить</a>";
                }
            }else{
                $html .= "<a download href='/images/{$model->file}'>{$model->file}</a> | ";
                $html .= "<a href='" . \yii\helpers\Url::to(["file/delimage", 'img' => base64_encode(implode("|", [$model->file, $model->id, 1]))]) . "'>Удалить</a>";
            }
        }else{
            $html .= $form->field($model, 'file')->fileInput();
        }

        $html .= "</div>";
        echo $html;

        ?>
        </div>
    </div>

    <?= $fields ?>

    <input type="text" id="title" style="display:none" name="File[title]" value="<?= $model->file ?>" aria-invalid="false">

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
