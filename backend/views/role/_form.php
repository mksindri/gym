<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\role */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_id')->textInput(['maxlength' => true]) ?>

    <div>
        <?php echo $form->field($model, 'status')
            ->dropDownList([ '1' => 'Active', '0' => 'Inactive' ], ['prompt' => '']);
        ?>
    </div>

    <?php // $form->field($model, 'create_date')->textInput() ?>

    <?php // $form->field($model, 'update_date')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
