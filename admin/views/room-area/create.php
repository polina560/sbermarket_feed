<?php

use common\components\helpers\UserUrl;
use common\models\RoomAreaSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\RoomArea
 */

$this->title = Yii::t('app', 'Create Room Area');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Room Areas'),
    'url' => UserUrl::setFilters(RoomAreaSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-area-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
