<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\WorkDaySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\WorkDay
 */

$this->title = Yii::t('app', 'Work Days');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-day-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?= 
            RbacHtml::a(Yii::t('app', 'Create Work Day'), ['create'], ['class' => 'btn btn-success']);
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
            Column::widget(['attr' => 'id_sale_info']),
            Column::widget(['attr' => 'day']),
            Column::widget(['attr' => 'open_at']),
            Column::widget(['attr' => 'close_at']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
