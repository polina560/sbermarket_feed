<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\InfrastructureSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Infrastructure
 */

$this->title = Yii::t('app', 'Infrastructures');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infrastructure-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?= 
            RbacHtml::a(Yii::t('app', 'Create Infrastructure'), ['create'], ['class' => 'btn btn-success']);
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
            Column::widget(['attr' => 'parking']),
            Column::widget(['attr' => 'security']),
            Column::widget(['attr' => 'fenced_area']),
//            Column::widget(['attr' => 'sports_ground']),
//            Column::widget(['attr' => 'playground']),
//            Column::widget(['attr' => 'school']),
//            Column::widget(['attr' => 'kindergarten']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
