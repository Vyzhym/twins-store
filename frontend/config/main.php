<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'   => 'ua',
    'sourceLanguage' => 'ua',
    'controllerNamespace' => 'frontend\controllers',
    'on beforeRequest' => function () {
        //Delete last slash or if only /en or /ru - then add it for correct work
        $pathInfo = Yii::$app->request->url;
        //die(print_r($pathInfo));
        //TODO FIX THIS
        if($pathInfo == '/ru/' || $pathInfo == '/ua/' || $pathInfo == '/'){
            return true;
        }elseif($pathInfo == '/ru' || $pathInfo == '/ua'){
            $url = $pathInfo."/";
            Yii::$app->response->redirect($url, 301);
            Yii::$app->end();
        }
        if (!empty($pathInfo) && substr($pathInfo, -1) === '/') {
            $url = substr($pathInfo, 0, -1);
            Yii::$app->response->redirect($url, 301);
            Yii::$app->end();
        }
    },

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
            'class' => 'pjhl\multilanguage\components\AdvancedRequest',
        ],


        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class' => 'pjhl\multilanguage\components\AdvancedUrlManager',
            'rules'=>[
                '/' => 'site/index',
                '<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
                '<language:(ru|ua)>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
            ]
        ],
        //'on beforeAction' => ['\pjhl\multilanguage\Start', 'run'],
    ],
    'params' => $params,
];
