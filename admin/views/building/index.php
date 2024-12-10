<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\BuildingSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Building
 */

$this->title = Yii::t('app', 'Buildings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?= 
            RbacHtml::a(Yii::t('app', 'Create Building'), ['create'], ['class' => 'btn btn-success']);
//           $this->render('_create_modal', ['model' => $model]);
        ?>
    </div>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            Column::widget(),
            Column::widget(['attr' => 'id_build']),
            Column::widget(['attr' => 'fz_214']),
            Column::widget(['attr' => 'id_complex']),
            Column::widget(['attr' => 'name']),
//            Column::widget(['attr' => 'floors']),
//            Column::widget(['attr' => 'floors_ready']),
//            Column::widget(['attr' => 'building_state']),
//            Column::widget(['attr' => 'image']),
//            Column::widget(['attr' => 'ceiling_height']),
//            Column::widget(['attr' => 'passenger_lifts_count']),
//            Column::widget(['attr' => 'cargo_lifts_count']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
