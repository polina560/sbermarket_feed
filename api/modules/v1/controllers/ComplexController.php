<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use common\components\exceptions\ModelSaveException;
use common\models\Building;
use common\models\Complex;
use common\models\DescriptionMain;
use common\models\Discount;
use common\models\Flat;
use common\models\Image;
use common\models\Param;
use common\models\Plan;
use common\models\ProfitMain;
use common\models\RoomArea;
use common\models\SaleInfo;
use common\models\WorkDay;
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

        foreach ($array_xml as $xml_complex) {
            $complex = $this->searchModelItem($complexes, $xml_complex['id']);
            if ($complex == null) {
                $complex = new Complex();
            }

            // вынести в отдельную функцию + проверка на существование тега
            if(!is_array($xml_complex['id']))$complex->id_complex = (int)$xml_complex['id'];
            if(!is_array($xml_complex['name']))$complex->name = $xml_complex['name'];
            if(!is_array($xml_complex['latitude']))$complex->latitude = $xml_complex['latitude'];
            if(!is_array($xml_complex['longitude']))$complex->longitude = $xml_complex['longitude'];
            if(!is_array($xml_complex['address']))$complex->address = $xml_complex['address'];
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

                    $image->image = $item;
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

                if(!is_array($xml_building['id'])) $building->id_build = (int)$xml_building['id'];
                if(!is_array($xml_building['fz_214']))$building->fz_214 = $xml_building['fz_214'];
                if(!is_array($xml_building['name']))$building->name = $xml_building['name'];
                $building->id_complex = $complex->id;
                if(array_key_exists('floors', $xml_building) && !is_array($xml_building['floors']))$building->floors = $xml_building['floors'];
                if(array_key_exists('floors_ready', $xml_building) && !is_array($xml_building['floors_ready']))$building->floors_ready = $xml_building['floors_ready'];
                if(array_key_exists('building_state', $xml_building) && !is_array($xml_building['building_state']))$building->building_state = $xml_building['building_state'];
                if(array_key_exists('image', $xml_building) && !is_array($xml_building['image']))$building->image = $this->imageSave($xml_building['image']);
                if(array_key_exists('ceiling_height', $xml_building) && !is_array($xml_building['ceiling_height']))$building->ceiling_height = $xml_building['ceiling_height'];
                if(array_key_exists('passenger_lifts_count', $xml_building) && !is_array($xml_building['passenger_lifts_count']))$building->passenger_lifts_count = $xml_building['passenger_lifts_count'];
                if(array_key_exists('cargo_lifts_count', $xml_building) && !is_array($xml_building['cargo_lifts_count']))$building->cargo_lifts_count = $xml_building['cargo_lifts_count'];
                if (!$building->save()) {
                    throw new ModelSaveException($building);
                }

                $flats = Flat::find()->where(['id_building' => $building->id])->all();
                $this->deleteModelItem($flats, $xml_building['flats']);
                foreach ($xml_building['flats']['flat'] as $xml_flat) {
                    $flat = $this->searchModelItem($flats, $xml_flat['flat_id']);
                    if ($flat == null) {
                        $flat = new Flat();
                    }
                    if(!is_array($xml_flat['flat_id']))$flat->flat_id = (int)$xml_flat['flat_id'];
                    $flat->id_building = $building->id;
                    if(!is_array($xml_flat['apartment']))$flat->apartment = $xml_flat['apartment'];
                    if(!is_array($xml_flat['floor']))$flat->floor = $xml_flat['floor'];
                    if(!is_array($xml_flat['room']))$flat->room = $xml_flat['room'];
                    if(array_key_exists('ceiling_height', $xml_building) && !is_array($xml_flat['ceiling_height']))$flat->ceiling_height = $xml_flat['ceiling_height'];
                    if(array_key_exists('description', $xml_building) && !is_array($xml_flat['description']))$flat->description = $xml_flat['description'];
                    if(array_key_exists('balcony', $xml_building) && !is_array($xml_flat['balcony']))$flat->balcony = $xml_flat['balcony'];
                    if(array_key_exists('renovation', $xml_building) && !is_array($xml_flat['renovation']))$flat->renovation = $xml_flat['renovation'];
                    if(!is_array($xml_flat['price']))$flat->price = $xml_flat['price'];
                    if(!is_array($xml_flat['area']))$flat->area = $xml_flat['area'];
                    if(!is_array($xml_flat['living_area']))$flat->living_area = $xml_flat['living_area'];
                    if(!is_array($xml_flat['kitchen_area']))$flat->kitchen_area = $xml_flat['kitchen_area'];
                    if(array_key_exists('window_view', $xml_building) && !is_array($xml_flat['window_view']))$flat->window_view = $xml_flat['window_view'];
                    if(array_key_exists('bathroom', $xml_building) && !is_array($xml_flat['bathroom']))$flat->bathroom = $xml_flat['bathroom'];
                    if(array_key_exists('layout_type', $xml_building) && !is_array($xml_flat['layout_type']))$flat->layout_type = $xml_flat['layout_type'];
                    if(!is_array($xml_flat['housing_type']))$flat->housing_type = $xml_flat['housing_type'];
                    if (!$flat->save()) {
                        throw new ModelSaveException($flat);
                    }

                    $plans = Plan::find()->where(['id_flat' => $flat->id])->all();
                    if (!empty($plans)) {
                        $this->deleteAllItems($plans);
                    }
                    if (!empty($xml_flat['plans']['plan']) && array_is_list($xml_flat['plans']['plan'])) {
                        foreach ($xml_flat['plans']['plan'] as $item) {
                            $plan = new Plan();
                            $plan->id_flat = $flat->id;
                            if(!is_array($item))$plan->plan = $item;
                            if (!$plan->save()) {
                                throw new ModelSaveException($plan);
                            }
                        }
                    }
                    else if(array_key_exists('plan', $xml_flat)){
                        $plan = new Plan();
                        $plan->id_flat = $flat->id;
                        if(!is_array($xml_flat['plan']))$plan->plan = $xml_flat['plan'];
                        if (!$plan->save()) {
                            throw new ModelSaveException($plan);
                        }

                    }

                    $rooms_area = RoomArea::find()->where(['id_flat' => $flat->id])->all();
                    if (!empty($rooms_area)) {
                        $this->deleteAllItems($rooms_area);
                    }
                    if (!empty($xml_flat['rooms_area']['area']) && array_is_list($xml_flat['rooms_area']['area'])) {
                        foreach ($xml_flat['rooms_area']['area'] as $item) {
                            $area = new RoomArea();
                            $area->id_flat = $flat->id;
                            if(!is_array($item))$area->area = $item;
                            if (!$area->save()) {
                                throw new ModelSaveException($area);
                            }
                        }
                    }

                }
            }

            $discounts = Discount::find()->where(['id_complex' => $complex->id])->all();
            if (!empty($discounts)) {
                $this->deleteAllItems($discounts);
            }
            if (!empty($xml_complex['discounts']['discount']) && array_is_list($xml_complex['discounts']['discount'])) {
                foreach ($xml_complex['discounts']['discount'] as $item) {
                    $discount = new Discount();
                    $discount->id_complex = $complex->id;
                    if(!is_array($item['description']))$discount->description = $item['description'];
                    if(!is_array($item['name']))$discount->name = $item['name'];
                    if (!$discount->save()) {
                        throw new ModelSaveException($discount);
                    }
                }
            }
            else if(array_key_exists('discount', $xml_complex)){
                $discount = new Discount();
                $discount->id_complex = $complex->id;
                if(!is_array($xml_complex['discount']['description']))$discount->description = $xml_complex['discount']['description'];
                if(!is_array($xml_complex['discount']['name']))$discount->name = $xml_complex['discount']['name'];
                if (!$discount->save()) {
                    throw new ModelSaveException($discount);
                }

            }

            $profits_main = ProfitMain::find()->where(['id_complex' => $complex->id])->all();
            if (!empty($profits_main)) {
                $this->deleteAllItems($profits_main);
            }
            if (!empty($xml_complex['profits_main']['profit_main']) && array_is_list($xml_complex['profits_main']['profit_main'])) {
                foreach ($xml_complex['profits_main']['profit_main'] as $item) {
                    $profit_main = new ProfitMain();
                    $profit_main->id_complex = $complex->id;
                    if(!is_array($item['title']))$profit_main->title = $item['title'];
                    if(!is_array($item['text']))$profit_main->text = $item['text'];
                    if(!is_array($item['image']))$profit_main->image = $item['image'];
                    if (!$profit_main->save()) {
                        throw new ModelSaveException($profit_main);
                    }
                }
            }
            else if(array_key_exists('profit_main', $xml_complex)){
                $profit_main = new ProfitMain();
                $profit_main->id_complex = $complex->id;
                if(!is_array($xml_complex['profit_main']['title']))$profit_main->title = $xml_complex['profit_main']['title'];
                if(!is_array($xml_complex['profit_main']['text']))$profit_main->text = $xml_complex['profit_main']['text'];
                if(!is_array($xml_complex['profit_main']['image']))$profit_main->image = $xml_complex['profit_main']['image'];
                if (!$profit_main->save()) {
                    throw new ModelSaveException($profit_main);
                }
            }

            $description_main = DescriptionMain::find()->where(['id_complex' => $complex->id])->all();
            if (!empty($description_main)) {
                $this->deleteAllItems($description_main);
            }
            if (!empty($xml_complex['description_main']) ) {
                $description_main = new DescriptionMain();
                $description_main->id_complex = $complex->id;
                if(array_key_exists('title', $xml_complex['description_main']))$description_main->title = $xml_complex['description_main']['title'];
                if(array_key_exists('text', $xml_complex['description_main']))$description_main->text = $xml_complex['description_main']['text'];
                if (!$description_main->save()) {
                    throw new ModelSaveException($description_main);
                }

            }

            $sales_info = SaleInfo::find()->where(['id_complex' => $complex->id])->all();
            if (!empty($sales_info)) {
                $this->deleteAllItems($sales_info);
            }
            if (!empty($xml_complex['sales_info'])) {
                $sale_info = new SaleInfo();
                $sale_info->id_complex = $complex->id;
                if(!is_array($xml_complex['sales_info']['sales_phone']))$sale_info->sales_phone = $xml_complex['sales_info']['sales_phone'];
                if(array_key_exists('address', ['sales_info']))$sale_info->address = $xml_complex['sales_info']['address'];
                if(array_key_exists('sales_latitude', $xml_complex['sales_info']))$sale_info->sales_latitude = $xml_complex['sales_info']['sales_latitude'];
                if(array_key_exists('sales_longitude', $xml_complex['sales_info']))$sale_info->sales_longitude = $xml_complex['sales_info']['sales_longitude'];
                if(!is_array($xml_complex['sales_info']['timezone']))$sale_info->timezone = $xml_complex['sales_info']['timezone'];
                if (!$sale_info->save()) {
                    throw new ModelSaveException($sale_info);
                }


                $work_days = WorkDay::find()->where(['id_sale_info' => $sale_info->id])->all();
                if (!empty($work_days)) {
                    $this->deleteAllItems($work_days);
                }
                if(array_key_exists('work_days', $xml_complex['sales_info']))
                    if (!empty($xml_complex['sales_info']['work_days']['work_day']) && array_is_list($xml_complex['sales_info']['work_days']['work_day'])) {
                        foreach ($xml_complex['sales_info']['work_days']['work_day'] as $item) {
                            $work_day = new WorkDay();
                            $work_day->id_sale_info = $sale_info->id;
                            $work_day->day = $item['day'];
                            $work_day->open_at = $item['open_at'];
                            $work_day->close_at = $item['close_at'];
                            if (!$work_day->save()) {
                                throw new ModelSaveException($work_day);
                            }
                        }
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
