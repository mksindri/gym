<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Fee;

/* @var $this yii\web\View */
/* @var $model backend\models\Fee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\backend\models\Users::find()->all(),'id','name'),
        ['prompt'=>'Select a User']) ?>

    <?= $form->field($model, 'fee')->textInput() ?>

    <?php // $form->field($model, 'fee_type')->textInput() ?>
    <?= $form->field($model, 'fee_type')->dropDownList(Fee::getFeeType(),
        ['prompt'=>'Select Fee Type']) ?>

    <?php // $form->field($model, 'created_by')->textInput() ?>

    <?php // $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'status')
        ->dropDownList([ '1' => 'Paid', '0' => 'Not Paid' ], ['prompt' => 'Please Select']);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
