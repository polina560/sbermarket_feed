<?php

use common\components\helpers\UserUrl;
use common\models\VideoSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Video
 */

$this->title = Yii::t('app', 'Create Video');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Videos'),
    'url' => UserUrl::setFilters(VideoSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
