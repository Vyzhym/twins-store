<?php

namespace backend\controllers;

use Yii;
use backend\models\File;
use backend\models\search\File as FileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends FileUploadController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single File model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function saveTitles($post){
        $t = [];
        foreach ($post['Title'] as $lang=>$item){
            $t[$lang]=$item;
        }
        return $t;
    }

    /**
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new File();

        $post = Yii::$app->request->post();
        if ($model->load($post)){


            $model->title=$this->saveTitles($post);

            if($model->save()) {
                Yii::$app->session->setFlash('success', "Сохраниение прошло успешно");
            }else{
                $errStr = "";
                foreach ($model->getErrors() as $error){
                    $errStr .= "{$error[0]}<br/>";
                }
                Yii::$app->session->setFlash('error', "Исправьте следующие ошибки:<br/>".$errStr);
                return $this->redirect(Yii::$app->request->referrer);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing File model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if ($model->load($post)) {

            $model->title=$this->saveTitles($post);

            if($model->save()) {
                Yii::$app->session->setFlash('success', "Сохраниение прошло успешно");
            }else{
                $errStr = "";
                foreach ($model->getErrors() as $error){
                    $errStr .= "{$error[0]}<br/>";
                }
                Yii::$app->session->setFlash('error', "Исправьте следующие ошибки:<br/>".$errStr);
                return $this->redirect(Yii::$app->request->referrer);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing File model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelimage($img)
    {
        $arr = explode("|", base64_decode($img));
        $path = Yii::getAlias("@frontend") .'/web/images/' . $arr[0];
        @unlink($path);
        $model = $this->findModel($arr[1]);
        if($arr[2]==1){
             $model->file = "";
             $model->deleting = true;
        }

        $model->save();
        return $this->redirect(['update', 'id' => $model->id]);
    }
}
