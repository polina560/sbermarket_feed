<?php

use admin\components\widgets\detailView\Column;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\RoomAreaSearch;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\RoomArea
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Room Areas'),
    'url' => UserUrl::setFilters(RoomAreaSearch::class)
];
$this->params['breadcrumbs'][] = RbacHtml::encode($this->title);
?>
<div class="room-area-view">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <p>
        <?= RbacHtml::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= RbacHtml::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post'
                ]
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            Column::widget(),
            Column::widget(['attr' => 'id_flat']),
            Column::widget(['attr' => 'area']),
        ]
    ]) ?>

</div>
