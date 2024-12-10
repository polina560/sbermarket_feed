<?php

use admin\components\widgets\detailView\Column;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\ComplexSearch;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Complex
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Complexes'),
    'url' => UserUrl::setFilters(ComplexSearch::class)
];
$this->params['breadcrumbs'][] = RbacHtml::encode($this->title);
?>
<div class="complex-view">

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
            Column::widget(['attr' => 'name']),
            Column::widget(['attr' => 'latitude']),
            Column::widget(['attr' => 'longitude']),
            Column::widget(['attr' => 'address']),
        ]
    ]) ?>

</div>
