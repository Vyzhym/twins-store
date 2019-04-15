<?php

namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;
use pjhl\multilanguage;
use pjhl\multilanguage\components\helpers\Detect;
use pjhl\multilanguage\LangHelper;
use pjhl\multilanguage\Start;

class Language extends multilanguage\Start
{

    private static $languages = [];

    public static function saveLang() {
        foreach (Yii::$app->params['languages'] as $lang){
            self::$languages[$lang['id']]=$lang['url'];
        }


        $languageInurl = Yii::$app->request->languageInurl;
            $current = '';

            if ($languageInurl !== null) {
                $idLang = array_search($languageInurl, self::$languages);
                if($idLang){
                    unset($_COOKIE ['x-language-id']);
                    Yii::$app->language = $languageInurl;
                    $current = setcookie('x-language-id', $idLang,time()+36000*6840, '/');
                }
            } else {

                    Yii::$app->language = 'ua';
                    $current = setcookie('x-language-id', 1,time()+36000*6840, '/');
            }
            return $current;
            }
}
