<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use common\components\exceptions\ModelSaveException;
use common\models\Building;
use common\models\Complex;
use common\models\Flat;
use common\models\Image;
use common\models\Param;
use common\models\Plan;
use common\models\XmlFile;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use Yii;
use yii\db\Exception;
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
        if(empty($xml)) {
            $xml = new XmlFile();
            $xml->key = 'feed_sber_xml';
            $xml->save();
        }
//        if(($xml->updated_at + 60 * 5) > time()){
            $content = $this->downaldXML($xml->id);
//            $xml->updated_at = time();
//            $xml->save();

//        }


        return $this->returnSuccess([
            'xml' => $content
        ]);
    }

    public function downaldXML(int $key)
    {
        $client = new Client();
        $response = $client->get(Yii::$app->environment->FEED_LINK)->setFormat(Client::FORMAT_XML)->send();

        $this->xmlParser($response->data, $key);
        $temp = '';
//        foreach ($response->data['complex']['images'] as $item)
//            foreach ($item as $i){
//                $temp .= $i;
//                return $temp;
//            }
        return $response->data;

    }

    /**
     * @throws Exception
     * @throws ModelSaveException
     */
    public function xmlParser(array $array_xml, int $xml_key): void
    {
        $complexes = Complex::find()->where(['id_feed' => $xml_key])->all();

        $this->deleteModelItem($complexes, $array_xml);
//        $new_complexes = $this->searchNewItem($complex, $array_xml);

        foreach ($array_xml as $xml_complex) {
            $complex = $this->searchModelItem($complexes, $xml_complex['id']);
            if ($complex == null) {
                $complex = new Complex();
            }

            // вынести в отдельную функцию + проверка на существование тега
            $complex->id_complex = (int)$xml_complex['id'];
            $complex->name = $xml_complex['name'];
            $complex->latitude = $xml_complex['latitude'];
            $complex->longitude = $xml_complex['longitude'];
            $complex->address = $xml_complex['address'];
            $complex->id_feed = $xml_key;
            if (!$complex->save()) {
                throw new ModelSaveException($complex);
            }


            $images = Image::find()->where(['id_complex' => $complex->id])->all();
            if (!empty($images)) {
                $this->deleteAllItems($images);
            }
            if (!empty($xml_complex['images']['image']) && array_is_list($xml_complex['images']['image'])) {
                foreach ($xml_complex['images']['image'] as $item) {
                    $image = new Image();
                    $image->id_complex = $complex->id;

                    $image->image = $this->imageSave($item);
                    if (!$image->save()) {
                        throw new ModelSaveException($image);
                    }
                }
            }

            $buildings = Building::find()->where(['id_complex' => $complex->id])->all();
            $this->deleteModelItem($buildings, $xml_complex['buildings']);

            foreach ($xml_complex['buildings'] as $xml_building) {
                $building = $this->searchModelItem($buildings, $xml_building['id']);
                if ($building == null) {
                    $building = new Building();
                }

                $building->id_build = (int)$xml_building['id'];
                $building->fz_214 = $xml_building['fz_214'];
                $building->id_complex = $complex->id;
//                $building->name = $xml_building['name'];
//                if(array_key_exists('floors', $xml_building))$building->floors = $xml_building['floors'];
//                if(array_key_exists('floors_ready', $xml_building))$building->floors_ready = $xml_building['floors_ready'];
//                if(array_key_exists('building_state', $xml_building))$building->building_state = $xml_building['building_state'];
//                if(array_key_exists('image', $xml_building))$building->image = $this->imageSave($xml_building['image']);
//                if(array_key_exists('ceiling_height', $xml_building))$building->ceiling_height = $xml_building['ceiling_height'];
//                if(array_key_exists('passenger_lifts_count', $xml_building))$building->passenger_lifts_count = $xml_building['passenger_lifts_count'];
//                if(array_key_exists('cargo_lifts_count', $xml_building))$building->cargo_lifts_count = $xml_building['cargo_lifts_count'];
                if (!$building->save()) {
                    throw new ModelSaveException($building);
                }
//
                $flats = Flat::find()->where(['id_building' => $building->id])->all();
                $this->deleteModelItem($flats, $xml_building['flats']);
                foreach ($xml_building['flats'] as $xml_flat) {
////                    $flat = $this->searchModelItem($flats, $xml_flat['flat_id']);
//                    if ($flat == null) {
//                        $flat = new Flat();
//                    }
//                    $flat->flat_id = $xml_flat['flat_id'];
//                    $flat->id_building = $building->id;
//                    $flat->apartment = $xml_flat['apartment'];
//                    $flat->floor = $xml_flat['floor'];
//                    $flat->room = $xml_flat['room'];
//                    if(array_key_exists('ceiling_height', $xml_building))$flat->ceiling_height = $xml_flat['ceiling_height'];
//                    if(array_key_exists('description', $xml_building))$flat->description = $xml_flat['description'];
//                    if(array_key_exists('balcony', $xml_building))$flat->balcony = $xml_flat['balcony'];
//                    if(array_key_exists('renovation', $xml_building))$flat->renovation = $xml_flat['renovation'];
//                    $flat->price = $xml_flat['price'];
//                    $flat->area = $xml_flat['area'];
//                    $flat->living_area = $xml_flat['living_area'];
//                    $flat->kitchen_area = $xml_flat['kitchen_area'];
//                    if(array_key_exists('window_view', $xml_building))$flat->window_view = $xml_flat['window_view'];
//                    if(array_key_exists('bathroom', $xml_building))$flat->bathroom = $xml_flat['bathroom'];
//                    if(array_key_exists('layout_type', $xml_building))$flat->layout_type = $xml_flat['layout_type'];
//                    $flat->housing_type = $xml_flat['housing_type'];
//                    if (!$flat->save()) {
//                        throw new ModelSaveException($flat);
//                    }

//                    $plan = Plan::find()->where(['id_flat' => $flat->id])->all();
                }
            }
        }
    }




    public function imageSave ($image):string
    {
        $temp = '';
        foreach($image as $i)
            $temp .= $i;

        return $temp;
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

    public function searchModelItem($model_items, $xml_item)
    {
        $isNewModel = 0;
        foreach ($model_items as $item) {
            if($item->id == $xml_item) {
                $isNewModel++;
                return $item;
            }
        }
        if($isNewModel == 0) return null;

    }

    public function deleteAllItems(array $model_items)
    {
        foreach ($model_items as $model_item) {
            $model_item->delete();
        }
    }


}
