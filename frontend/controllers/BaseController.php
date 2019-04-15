<?php
namespace frontend\controllers;

use backend\models\File;
use backend\models\Message;
use backend\models\Service;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\Language;

/**
 * Site controller
 */
class BaseController extends Controller
{


    public function init(){
        parent::init();
        Language::saveLang();
    }

    /**
     * Return language message
     * @param $id
     * @return string
     */
    public static function getMessage($id){
        $arMess = Yii::$app->cache->get('messages');
        if($arMess === false){
            $arMess = Message::find()->asArray()->indexBy('id')->all();
            Yii::$app->cache->set('messages', $arMess, Yii::$app->params['cache']['messages']);
        }

        $arMess[$id]['message'] = json_decode($arMess[$id]['message'],1);
        if($arMess[$id]){
            return $arMess[$id]['message'][Yii::$app->language];
        }else{
            return '';
        }

    }

    /**
     * Return service
     * @param $id
     * @return string
     */
    public static function getService($id){
        $arMess = Yii::$app->cache->get('services');
        if($arMess === false){
            $arMess = Service::find()->asArray()->indexBy('id')->all();
            Yii::$app->cache->set('services', $arMess, Yii::$app->params['cache']['services']);
        }
        if($arMess[$id]){
            return $arMess[$id]['value'];
        }else{
            return '';
        }

    }

    /**
     * Return file and leng title
     * @param $id
     * @return string
     */
    public static function getFile($id){
        $arRes = Yii::$app->cache->get('files');
        if($arRes === false){
            $arRes = File::find()->asArray()->indexBy('id')->all();
            Yii::$app->cache->set('files', $arRes, Yii::$app->params['cache']['files']);
        }
        if($arRes[$id]){
            $arTemp[$id]['title'] = json_decode($arRes[$id]['title'],1);
            $arTemp[$id]['title'] = $arTemp[$id]['title'][Yii::$app->language];
            $arTemp[$id]['file']=$arRes[$id]['file'];
            return $arTemp[$id];
        }else{
            return ["title"=>"", "file"=>""];
        }

    }

}
