<?php

namespace d2emon\advice\controllers;

use Yii;
use d2emon\advice\models\Advice;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

use yii\helpers\Json;

/**
 * Default controller for the `advice` module
 */
class DefaultController extends Controller
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
     * Lists all Advice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Advice::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Advice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id=0)
    {
	$model = ($id != 0) ? $this->findModel($id) : Advice::find()->orderBy('rand()')->one();
	if(!$id){
	    return $this->redirect(['view', 'id'=>$model->id]);
	}
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Advice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Advice();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload() && $model->save()) {
	        // file is uploaded successfully
            	return $this->redirect(['view', 'id' => $model->id]);
	    }
        }
            return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing Advice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload() && $model->save()) {
	        // file is uploaded successfully
            	return $this->redirect(['view', 'id' => $model->id]);
	    }
        }
            return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Advice model.
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
     * Uploads images into Advice model.
     * @return mixed
     */
    public function actionUpload()
    {
	$advice_id = Yii::$app->request->post('advice_id', 0);
	$model = Advice::findOne($advice_id);
	if(!$model){
	    $model = new Advice;
	}

	$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        if ($model->upload()) {
	    if ($advice_id) {
		return Json::encode($model->save());
	    }else{
		Yii::$app->session->setFlash('image', $model->image);
	        return Json::encode(True);
	    }
	    // file is uploaded successfully
	}
	return Json::encode(False);
    }

    /**
     * Finds the Advice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
