<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\DiscountSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Discount
 */

$this->title = Yii::t('app', 'Discounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?= 
            RbacHtml::a(Yii::t('app', 'Create Discount'), ['create'], ['class' => 'btn btn-success']);
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
            Column::widget(['attr' => 'name']),
            Column::widget(['attr' => 'description']),
            Column::widget(['attr' => 'image']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
