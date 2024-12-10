<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\FlatSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Flat
 */

$this->title = Yii::t('app', 'Flats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flat-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?= 
            RbacHtml::a(Yii::t('app', 'Create Flat'), ['create'], ['class' => 'btn btn-success']);
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
            Column::widget(['attr' => 'flat_id']),
            Column::widget(['attr' => 'id_building']),
            Column::widget(['attr' => 'apartment']),
            Column::widget(['attr' => 'floor']),
//            Column::widget(['attr' => 'room']),
//            Column::widget(['attr' => 'ceiling_height']),
//            Column::widget(['attr' => 'description']),
//            Column::widget(['attr' => 'balcony']),
//            Column::widget(['attr' => 'renovation']),
//            Column::widget(['attr' => 'price']),
//            Column::widget(['attr' => 'area']),
//            Column::widget(['attr' => 'living_area']),
//            Column::widget(['attr' => 'kitchen_area']),
//            Column::widget(['attr' => 'window_view']),
//            Column::widget(['attr' => 'bathroom']),
//            Column::widget(['attr' => 'layout_type']),
//            Column::widget(['attr' => 'housing_type']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
