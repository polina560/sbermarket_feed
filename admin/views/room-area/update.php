<?php

use common\components\helpers\UserUrl;
use common\models\RoomAreaSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\RoomArea
 */

$this->title = Yii::t('app', 'Update Room Area: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Room Areas'),
    'url' => UserUrl::setFilters(RoomAreaSearch::class)
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->id), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="room-area-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => false]) ?>

</div>
