<?php

use admin\components\widgets\detailView\Column;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\FlatSearch;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Flat
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Flats'),
    'url' => UserUrl::setFilters(FlatSearch::class)
];
$this->params['breadcrumbs'][] = RbacHtml::encode($this->title);
?>
<div class="flat-view">

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
            Column::widget(['attr' => 'flat_id']),
            Column::widget(['attr' => 'id_building']),
            Column::widget(['attr' => 'apartment']),
            Column::widget(['attr' => 'floor']),
            Column::widget(['attr' => 'room']),
            Column::widget(['attr' => 'ceiling_height']),
            Column::widget(['attr' => 'description']),
            Column::widget(['attr' => 'balcony']),
            Column::widget(['attr' => 'renovation']),
            Column::widget(['attr' => 'price']),
            Column::widget(['attr' => 'area']),
            Column::widget(['attr' => 'living_area']),
            Column::widget(['attr' => 'kitchen_area']),
            Column::widget(['attr' => 'window_view']),
            Column::widget(['attr' => 'bathroom']),
            Column::widget(['attr' => 'layout_type']),
            Column::widget(['attr' => 'housing_type']),
        ]
    ]) ?>

</div>
