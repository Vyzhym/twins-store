<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$fieldCode="Message";
$fields = "";
foreach (Yii::$app->params['languages'] as $lang){
    $pref = $lang['url'];
    $field = $fieldCode."[".$lang['url']."]";
    $value = (isset($model->message[$pref])) ? $model->message[$pref] : "";
    $col_md = "col-md-".(int)(12/count(Yii::$app->params['languages']));
    $fields .= '
<div class="form-group field-message-message has-success '.$col_md.'">
    <label class="control-label" for="message-message">'.$field.'</label>
    <textarea id="message-message" class="form-control" name="'.$field.'" maxlength="255" rows="6" aria-invalid="false">'.$value.'</textarea>
</div>';
}
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $fields ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
