<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InmueblesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inmuebles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'n_habitaciones') ?>

    <?= $form->field($model, 'n_wc') ?>

    <?= $form->field($model, 'precio_minimo') ?>

    <?= $form->field($model, 'precio_maximo') ?>

    <?php echo $form->field($model, 'has_lavavajillas')->dropDownList([ null => "Indiferente", 1 => "Sí", 0 => "No"]) ?>

    <?php echo $form->field($model, 'has_garage')->dropDownList([ null => "Indiferente", 1 => "Sí", 0 => "No"]) ?>

    <?php echo $form->field($model, 'has_trastero')->dropDownList([ null => "Indiferente", 1 => "Sí", 0 => "No"]) ?>


    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
