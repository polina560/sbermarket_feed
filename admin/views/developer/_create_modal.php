<?php

use admin\modules\rbac\components\RbacHtml;
use yii\bootstrap5\Modal;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Developer
 */
?>

<?php $modal = Modal::begin([
    'title' => Yii::t('app', 'New Developer'),
    'toggleButton' => [
        'label' => Yii::t('app', 'Create Developer'),
        'class' => 'btn btn-success',
        'disabled' => !RbacHtml::isAvailable(['create'])
    ]
]) ?>

<?= $this->render('_form', ['model' => $model, 'isCreate' => false]) ?>

<?php Modal::end() ?>
