<?php

namespace backend\controllers;

use common\models\Organization;
use backend\models\OrganizationSearch;
use common\models\OrganizationRequisite;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class OrganizationController extends BaseController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'className' => Organization::className(),
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Organization models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Organization model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Organization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Organization();
        $requisites = new OrganizationRequisite();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) and $requisites->load($this->request->post())) {
                if($model->save()) {
                    $requisites->organization_id = $model->id;
                    if($requisites->save()) {

                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'requisites' => $requisites
        ]);
    }

    /**
     * Updates an existing Organization model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $requisites = $model->_requisites ?? new OrganizationRequisite();

        if ($this->request->isPost && $model->load($this->request->post()) && $requisites->load($this->request->post())) {
            $model->_requisites = $requisites;
            if($model->save()) {
                return $this->redirect(['index']);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'requisites' => $requisites
        ]);
    }
}
