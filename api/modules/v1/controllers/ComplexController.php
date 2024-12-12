<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use common\models\Building;
use common\models\Complex;
use common\models\Image;
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
//        if(($xml->updated_at + 60 * 5) > time()){
            $content = $this->downaldXML();
//            $xml->updated_at = time();
//            $xml->save();

//        }


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
        $this->xmlParser($array_xml);
        $temp = [];
        foreach ($array_xml['complex']['images'] as $item)
            $temp[] = $item;
        return $temp;
    }

    public function xmlParser(array $array_xml): void
    {

        $complexes = Complex::find()->all();

        $this->deleteModelItem($complexes, $array_xml);
//        $new_complexes = $this->searchNewItem($complex, $array_xml);

        foreach ($array_xml as $xml_complex) {
            $isNewComplex = 0;
            $modelComplex = null;
            foreach ($complexes as $complex) {
                if($complex->id == $xml_complex['id']) {
                    $isNewComplex++;
                    $modelComplex = $complex;
                    return;
                }
            }
            if($isNewComplex == 0) $modelComplex = new Complex();

            // вынести в отдельную функцию + проверка на существование тега
            $modelComplex->id = (int)$xml_complex['id'];
            $modelComplex->name = $xml_complex['name'];
            $modelComplex->latitude = $xml_complex['latitude'];
            $modelComplex->longitude = $xml_complex['longitude'];
            $modelComplex->address = $xml_complex['address'];
            $modelComplex->save();


            $images = Image::find()->where(['id_complex' => $modelComplex->id])->all();
            if(!empty($images)) $this->deleteAllItems($images);

            foreach ($xml_complex['images'] as $item){
                $image = new Image();
                $image->id_complex = (int)$xml_complex['id'];
                $image->image = $xml_complex['image'];
                $image->save();
            }

            $buildings = Building::find()->where(['id_complex' => $modelComplex->id])->all();
            $this->deleteModelItem($buildings, $array_xml);

            foreach ($xml_complex['buildings'] as $xml_building) {
                $isNewBuilding = 0;
                $modelBuilding = null;
                foreach ($buildings as $building) {
                    if($complex->id == $xml_building['id']) {
                        $isNewBuilding++;
                        $modelBuilding = $building;
                        return;
                    }
                }
                if($isNewBuilding == 0) $modelBuilding = new Building();

                $modelBuilding->id = (int)$xml_building['id'];
                $modelBuilding->fz_214 = $xml_building['fz_214'];
                $modelBuilding->id_complex = $xml_building['id'];
                $modelBuilding->name = $xml_building['id'];
                $modelBuilding->floors = $xml_building['id'];
                $modelBuilding->floors_ready = $xml_building['id'];
                $modelBuilding->building_state = $xml_building['id'];
                $modelBuilding->image = $xml_building['id'];
            }
        }



    }

    public function deleteModelItem($model_items, $array_model)
    {
        if(empty($model_items)) return;
        foreach ($model_items as $model) {
            $cnt = 0;
            foreach ($array_model as $item){
                if((int)$item['id'] == $model->id) {
                    $cnt++;
                    return;
                }
            }
            if($cnt == 0) $model->delete();
        }
    }

//    public function searchNewItem($model_items, $array_model)
//    {
//        if(empty($model_items)) return $array_model;
//        $new_items = [];
//        foreach ($array_model as $item) {
//            $cnt = 0;
//            foreach ($model_items as $model) {
//                if ((int)$model->id == $item['id']) {
//                    //обновить существующие
//                    $cnt++;
//                    return;
//                }
//            }
//            if($cnt == 0) $new_items [] = $item;
//        }
//            return $new_items;
//    }

    public function deleteAllItems(array $model_items)
    {
        foreach ($model_items as $model_item) {
            $model_item->delete();
        }
    }


}
