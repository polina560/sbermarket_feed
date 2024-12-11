<?php

use common\widgets\AppActiveForm;
use kartik\icons\Icon;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/**
 * @var $this     yii\web\View
 * @var $model    common\models\Infrastructure
 * @var $form     AppActiveForm
 * @var $isCreate bool
 */
?>

<div class="infrastructure-form">

    <?php $form = AppActiveForm::begin() ?>

    <?= $form->field($model, 'id_complex')->textInput() ?>

    <?= $form->field($model, 'parking')->textInput() ?>

    <?= $form->field($model, 'security')->textInput() ?>

    <?= $form->field($model, 'fenced_area')->textInput() ?>

    <?= $form->field($model, 'sports_ground')->textInput() ?>

    <?= $form->field($model, 'playground')->textInput() ?>

    <?= $form->field($model, 'school')->textInput() ?>

    <?= $form->field($model, 'kindergarten')->textInput() ?>

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
