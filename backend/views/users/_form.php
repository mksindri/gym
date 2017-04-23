<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Users;
use yii\helpers\ArrayHelper;
use backend\models\Role;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'role_id')->textInput()
    // ?>
    <?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map(Role::find()->all(),'id','name'),
        ['prompt'=>'Select a Role']) ?>


    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?php // $form->field($model, 'status')->textInput() ?>
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
