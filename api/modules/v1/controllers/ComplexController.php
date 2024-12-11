<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use Yii;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;

class ComplexController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), ['auth' => ['except' => ['index']]]);
    }

    #[Get(
        path: '/complex/index',
        operationId: 'complex-index',
        description: 'Получает xml-файл фида',
        summary: 'Фид',
        security: [['bearerAuth' => []]],
        tags: ['complex']
    )]
    #[JsonSuccess(content: [
        new Property(
            property: 'complex', type: 'array',
            items: new Items(ref: '#/components/schemas/Complex'),
        )
    ])]
    public function actionIndex(): array
    {

        $file = $this->getWeatherHttpClient();
        if (!$file) {
            return $this->returnError([
                'Ошибка 500'
            ]);
        }


        return $this->returnSuccess([
            'xml' => $file
        ]);
    }

    public function getWeatherHttpClient()
    {

        $url = Yii::$app->environment->FEED_LINK;


       $xml = file_get_contents($url);
    }
}
