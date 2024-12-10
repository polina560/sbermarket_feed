<?php

use admin\components\widgets\detailView\Column;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\BuildingSearch;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Building
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Buildings'),
    'url' => UserUrl::setFilters(BuildingSearch::class)
];
$this->params['breadcrumbs'][] = RbacHtml::encode($this->title);
?>
<div class="building-view">

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
            Column::widget(['attr' => 'id_build']),
            Column::widget(['attr' => 'fz_214']),
            Column::widget(['attr' => 'id_complex']),
            Column::widget(['attr' => 'name']),
            Column::widget(['attr' => 'floors']),
            Column::widget(['attr' => 'floors_ready']),
            Column::widget(['attr' => 'building_state']),
            Column::widget(['attr' => 'image']),
            Column::widget(['attr' => 'ceiling_height']),
            Column::widget(['attr' => 'passenger_lifts_count']),
            Column::widget(['attr' => 'cargo_lifts_count']),
        ]
    ]) ?>

</div>
