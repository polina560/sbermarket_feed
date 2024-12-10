<?php

use common\components\helpers\UserUrl;
use common\models\ImageSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Image
 */

$this->title = Yii::t('app', 'Create Image');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Images'),
    'url' => UserUrl::setFilters(ImageSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
