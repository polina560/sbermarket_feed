<?php

use common\widgets\AppActiveForm;
use kartik\icons\Icon;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/**
 * @var $this     yii\web\View
 * @var $model    common\models\Building
 * @var $form     AppActiveForm
 * @var $isCreate bool
 */
?>

<div class="building-form">

    <?php $form = AppActiveForm::begin() ?>

    <?= $form->field($model, 'id_build')->textInput() ?>

    <?= $form->field($model, 'fz_214')->textInput() ?>

    <?= $form->field($model, 'id_complex')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'floors')->textInput() ?>

    <?= $form->field($model, 'floors_ready')->textInput() ?>

    <?= $form->field($model, 'building_state')->textInput() ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ceiling_height')->textInput() ?>

    <?= $form->field($model, 'passenger_lifts_count')->textInput() ?>

    <?= $form->field($model, 'cargo_lifts_count')->textInput() ?>

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
