<?php

use common\components\helpers\UserUrl;
use common\models\DeveloperSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Developer
 */

$this->title = Yii::t('app', 'Create Developer');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Developers'),
    'url' => UserUrl::setFilters(DeveloperSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="developer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
