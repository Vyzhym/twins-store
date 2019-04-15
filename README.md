Yii 2 advanced (AdminLTE, RBACK)
===============================  
```  
  composer self-update
  composer install
  php init
  Прописываем параметры подключения к БД в \common\config\main.php
  yii migrate
```  
rbac  
```  
php yii migrate --migrationPath=@yii/rbac/migrations/  
```  
How to use  
```  
Yii::$app->user->can('nameOfPermission')  
```