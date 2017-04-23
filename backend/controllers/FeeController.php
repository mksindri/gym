<?php

namespace backend\controllers;

use Yii;
use backend\models\Fee;
use backend\models\FeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FeeController implements the CRUD actions for Fee model.
 */
class FeeController extends Controller
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
     * Lists all Fee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Fee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fee();
        if ($model->load(Yii::$app->request->post())){
            $now = Yii::$app->formatter->asDatetime('now','php:Y-m-d H:i:s');
            $model->create_date = $now;
            if($model->fee_type == Fee::FEE_TYPE_MONTHLY)
                $last_date = date('Y-m-d H:i:s', strtotime("+1 month", strtotime($model->create_date)));
            else if($this->fee_type == Fee::FEE_TYPE_QUATERLY)
                $last_date = date('Y-m-d H:i:s', strtotime("+3 months", strtotime($model->create_date)));
            else if($this->fee_type == Fee::FEE_TYPE_YEARLY)
                $last_date = date('Y-m-d H:i:s', strtotime("+1 year", strtotime($model->create_date)));

            $model->last_date = $last_date;
            $model->created_by = 1 ;
            //$model->created_by = Yii::$app->user->identity->id ;
            $model->save();
            return $this->redirect(['view', 'id' => $model->int]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Fee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->int]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Fee model.
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
     * Finds the Fee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fee::findOne($id)) !== null) {
            return $model;
        } else {
            //throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
