<?php

namespace app\controllers;

use Yii;
use app\models\ProjectProposalYear;
use app\models\ProjectProposalYearSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ProjectProposal;
use app\models\AttachFile;
use yii\web\UploadedFile;
/**
 * ProjectProposalYearController implements the CRUD actions for ProjectProposalYear model.
 */
class ProjectProposalYearController extends Controller
{
    /**
     * {@inheritdoc}
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

    public function actions()
    {
        if(empty(Yii::$app->user->id))
        {
            $this->redirect(['site/login']);
        }
        return parent::actions();
    }
    /**
     * Lists all ProjectProposalYear models.
     * @return mixed
     */
    public function actionIndex()
    {
        unset( Yii::$app->session['model_items']);
        $searchModel = new ProjectProposalYearSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectProposalYear model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProjectProposalYear model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectProposalYear();
        $model->date=date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!empty(Yii::$app->session['model_items'])) {
                foreach (Yii::$app->session['model_items'] as $listprojects) {
                    $proposal=new ProjectProposal;
                    $proposal->project_proposal_year_id=$model->id;
                    $proposal->project_name=$listprojects->project_name;
                    $proposal->start_year=$listprojects->start_year;
                    $proposal->end_year=$listprojects->end_year;
                    $proposal->amount=$listprojects->amount;
                    $proposal->code_old_project=$listprojects->code_old_project;
                    $proposal->save();
                }
                unset(Yii::$app->session['model_items']);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProjectProposalYear model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->date=date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach (Yii::$app->session['model_items'] as $listprojects) {
                $proposal=ProjectProposal::find()->where(['id'=>$listprojects->id])->one();
                if(empty($proposal))
                {
                    $proposal=new ProjectProposal;
                }
                $proposal->project_proposal_year_id=$model->id;
                $proposal->project_name=$listprojects->project_name;
                $proposal->start_year=$listprojects->start_year;
                $proposal->end_year=$listprojects->end_year;
                $proposal->amount=$listprojects->amount;
                $proposal->code_old_project=$listprojects->code_old_project;
                $proposal->save();
            }
            unset( Yii::$app->session['model_items']);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if (empty(Yii::$app->session['model_items'])) {
            Yii::$app->session['model_items']=ProjectProposal::find()->where(['project_proposal_year_id'=>$model->id])->orderBy('id DESC')->all();
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProjectProposalYear model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectProposalYear model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectProposalYear the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectProposalYear::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAddprojects(){
        $model_item=new ProjectProposal();
        $model_item_arr=[];
        if(empty($_POST['project_name']) || empty($_POST['start_year']) || empty($_POST['amount'])){
            Yii::$app->session->setFlash('success', Yii::t('app','ທ່ານ​ຕ້ອງ​ປ້ອນ​ລາຍ​ການ​ໃຫ້​ຖືກ.'));
        }else{
           $model_item->project_name=$_POST['project_name'];
           $model_item->start_year=$_POST['start_year'];
           $model_item->end_year=$_POST['end_year'];
           $model_item->amount=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['amount']),0,-2);
           $model_item->code_old_project=$_POST['code_old_project'];
           $model_item_arr[]=$model_item;
           if(!empty(Yii::$app->session['model_items']))
           {
                Yii::$app->session['model_items']=array_merge($model_item_arr,Yii::$app->session['model_items']);
           }else{
               Yii::$app->session['model_items']=$model_item_arr;
           }
           
        }

        return $this->renderAjax('_list_form_project');
    }
    public function actionDelproject()
    {
        $arr=[];
        foreach (Yii::$app->session['model_items'] as $key=>$model_item) {
            if ($key!=$_POST['key_array']) {
                $arr[$key]=$model_item;
            }else{
                if(!empty($_POST['id']))
                {
                    $model_del=ProjectProposal::find()->where(['id'=>(int)$_POST['id']])->one();
                    $model_del->delete();
                }
            }
        }
        Yii::$app->session['model_items']=$arr;
    }

    public function actionEditprojects($id)
    {
        $model=Yii::$app->session['model_items'][$id];
        if(isset($_POST['project_name']))
        {
            $model_item_arr=[];
            foreach (Yii::$app->session['model_items'] as $key=>$model_item) {
                //$model_item=new ProjectProposal();
                if ($key==$id) {
                    $model_item->project_name=$_POST['project_name'];
                    $model_item->start_year=$_POST['start_year'];
                    $model_item->end_year=$_POST['end_year'];
                    $model_item->amount=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['amount']), 0, -2);
                    $model_item->code_old_project=$_POST['code_old_project'];
                    $model_item_arr[$key]=$model_item;
                }else{
                    $model_item_arr[$key]=$model_item;
                }
            }
           return $this->renderAjax('_list_form_project');
        }
        return $this->renderAjax('_edit_form_project',['model'=>$model,'key'=>$id]);
    }

    public function actionReportexternal()
    {
        $model = new ProjectProposalYear();
        if ($model->load(Yii::$app->request->post())) {
        }
        return $this->render('reportexternal',['model'=>$model]);
    }
    
    public function actionDownload()
    {
    header('Content-Type: application/force-download');
    header('Content-disposition: attachment; filename=export.xls');
    // Fix for crappy IE bug in download.
    header("Pragma: ");
    header("Cache-Control: ");
    return $_POST['text'];
    }

    public function actionUploadfile($id,$prid)
    {   $model=AttachFile::find()->where(['id'=>$id])->one();
        if(empty($model))
        {
            $model=new AttachFile();
        }
        
        if($model->load(Yii::$app->request->post()))
        {
            $model->name = UploadedFile::getInstance($model, 'name');
            $photo_name = date('YmdHmsi') . '.' . $model->name->extension;
            $model->name->saveAs(Yii::$app->basePath . '/web/file/' . $photo_name);
            $model->name = $photo_name;
            $model->project_proposal_id=$id;
            $model->save();
            return $this->redirect(['project-proposal-year/view','id'=>$prid]);
        }
        return $this->renderAjax('_form_upload_file',['model'=>$model]);
    }

    public function actionDownloadfile($name)
    {
        Yii::$app->response->sendFile(Yii::$app->basePath . '/web/file/' .$name);
    }

    public function actionDeletefile($id,$prid)
    {
        $model=AttachFile::find()->where(['id'=>$id])->one();
        unlink(Yii::$app->basePath . '/web/file/' .$model->name);
        $model->delete();
        return $this->redirect(['project-proposal-year/view','id'=>$prid]);
    }
}
