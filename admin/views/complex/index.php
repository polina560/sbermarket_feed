<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\ComplexSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Complex
 */

$this->title = Yii::t('app', 'Complexes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complex-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?= 
            RbacHtml::a(Yii::t('app', 'Create Complex'), ['create'], ['class' => 'btn btn-success']);
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
            Column::widget(['attr' => 'name']),
            Column::widget(['attr' => 'latitude']),
            Column::widget(['attr' => 'longitude']),
            Column::widget(['attr' => 'address']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
