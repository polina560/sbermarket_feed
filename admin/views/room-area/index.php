<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\RoomAreaSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\RoomArea
 */

$this->title = Yii::t('app', 'Rooms Area');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-area-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?=
            RbacHtml::a(Yii::t('app', 'Create Room Area'), ['create'], ['class' => 'btn btn-success']);
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
            Column::widget(['attr' => 'id_flat']),
            Column::widget(['attr' => 'area']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
