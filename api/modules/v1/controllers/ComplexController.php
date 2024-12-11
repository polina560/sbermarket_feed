<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use common\models\Param;
use common\models\XmlFile;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use Yii;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\XmlParser;

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

        $xml = XmlFile::findOne(['key' => 'feed_sber_xml']);
        if(($xml->updated_at + 60 * 5) > time()){
            $content = $this->downaldXML();
            $xml->updated_at = time();
            $xml->save();

        }


        return $this->returnSuccess([
            'xml' => $content
        ]);
    }

    public function downaldXML()
    {
        $client = new Client();
        $response = $client->get(Yii::$app->environment->FEED_LINK)->setFormat(Client::FORMAT_XML)->send();

        $parser = new XMLParser();
        $array_xml = $parser->parse($response);
        return $array_xml;
    }

//    public function xmlParser(): string
//    {
//
//    }


}
