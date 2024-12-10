<?php

use common\widgets\AppActiveForm;
use kartik\icons\Icon;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/**
 * @var $this     yii\web\View
 * @var $model    common\models\Flat
 * @var $form     AppActiveForm
 * @var $isCreate bool
 */
?>

<div class="flat-form">

    <?php $form = AppActiveForm::begin() ?>

    <?= $form->field($model, 'flat_id')->textInput() ?>

    <?= $form->field($model, 'id_building')->textInput() ?>

    <?= $form->field($model, 'apartment')->textInput() ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'room')->textInput() ?>

    <?= $form->field($model, 'ceiling_height')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balcony')->textInput() ?>

    <?= $form->field($model, 'renovation')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'area')->textInput() ?>

    <?= $form->field($model, 'living_area')->textInput() ?>

    <?= $form->field($model, 'kitchen_area')->textInput() ?>

    <?= $form->field($model, 'window_view')->textInput() ?>

    <?= $form->field($model, 'bathroom')->textInput() ?>

    <?= $form->field($model, 'layout_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'housing_type')->textInput() ?>

    <div class="form-group">
        <?php if ($isCreate) {
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Create New'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=create']
            );
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Return To List'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=index']
            );
        } ?>
        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php AppActiveForm::end() ?>

</div>
