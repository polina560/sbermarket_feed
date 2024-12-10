<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\SaleInfoSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\SaleInfo
 */

$this->title = Yii::t('app', 'Sale Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-info-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?= 
            RbacHtml::a(Yii::t('app', 'Create Sale Info'), ['create'], ['class' => 'btn btn-success']);
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
            Column::widget(['attr' => 'id_complex']),
            Column::widget(['attr' => 'sales_phone']),
            Column::widget(['attr' => 'address']),
            Column::widget(['attr' => 'sales_latitude']),
//            Column::widget(['attr' => 'sales_longitude']),
//            Column::widget(['attr' => 'timezone']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
