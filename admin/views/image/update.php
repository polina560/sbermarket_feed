<?php

use common\components\helpers\UserUrl;
use common\models\ImageSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Image
 */

$this->title = Yii::t('app', 'Update Image: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Images'),
    'url' => UserUrl::setFilters(ImageSearch::class)
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->id), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => false]) ?>

</div>
