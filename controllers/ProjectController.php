<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ProjectProgression;
use app\models\ProjectPayment;
use app\models\Loan;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $projectprogress=ProjectProgression::find()->where(['project_id'=>$id])->orderBy('project_year DESC')->all();
        return $this->render('view', [
            'model' =>$model,
            'projectprogress'=>$projectprogress
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        unset(Yii::$app->session['project_id']);
        unset(Yii::$app->session['is_oda']);
        unset(\Yii::$app->session['project_progress_save']);
        $model = new Project();
        $loan=new Loan();
        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->govt_budget)) {
                $postgovt_budget=$model->govt_budget;
                $model->govt_budget=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $model->govt_budget), 0, -2);
                if ($model->govt_budget==0) {
                    $model->govt_budget=$postgovt_budget;
                }
            }
            if (!empty($model->oda_budget)) {
                $postoda_budget=$model->oda_budget;
                $model->oda_budget=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $model->oda_budget), 0, -2);
                if ($model->oda_budget==0) {
                    $model->oda_budget=$postoda_budget;
                }
            }
            if (!empty($model->approved_govt_budget)) {
                $postapproved_govt_budget=$model->approved_govt_budget;
                $model->approved_govt_budget=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $model->approved_govt_budget), 0, -2);
                if ($model->approved_govt_budget==0) {
                    $model->approved_govt_budget=$postapproved_govt_budget;
                }    
            }
            if ($model->save()) {
                if (!empty(\Yii::$app->session['project_progress'])) {
                    $projectprogress=\Yii::$app->session['project_progress'];
                    $projectprogress->project_id=$model->id;
                    $projectprogress->save();
                }
                if (Yii::$app->request->post()['Loan']['project_id']==1) {
                    $loan->load(Yii::$app->request->post());
                    $loan->project_id=$model->id;
                    $postamount=$loan->amount;
                    $loan->amount=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $loan->amount), 0, -2);
                    if ($loan->amount==0) {
                        $loan->amount=$postamount;
                    }
                    $loan->save();
                    //print_r($loan->getErrors());exit;
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'loan'=>$loan
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        unset(\Yii::$app->session['project_progress']);
        $model = $this->findModel($id);
        $loan=Loan::find()->where(['project_id'=>$id])->one();
        if (empty($loan)) {
            $loan=new Loan();
        } else {
            $loan->project_id=1; /// set 1 is using teck checkbox
        }
        Yii::$app->session['project_id']=$id;
        Yii::$app->session['is_oda']=$model->is_oda;
        if ($model->load(Yii::$app->request->post())) {
            $postgovt_budget=$model->govt_budget;
            $model->govt_budget=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $model->govt_budget), 0, -2);
            if ($model->govt_budget==0) {
                $model->govt_budget=$postgovt_budget;
            }

            $postoda_budget=$model->oda_budget;
            $model->oda_budget=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $model->oda_budget), 0, -2);
            if ($model->oda_budget==0) {
                $model->oda_budget=$postoda_budget;
            }

            $postapproved_govt_budget=$model->approved_govt_budget;
            $model->approved_govt_budget=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $model->approved_govt_budget), 0, -2);
            if ($model->approved_govt_budget==0) {
                $model->approved_govt_budget=$postapproved_govt_budget;
            }

            if ($model->save()) {
                if (Yii::$app->request->post()['Loan']['project_id']==1) {
                    $loan->load(Yii::$app->request->post());
                    $loan->project_id=$model->id;
                    $postamount=$loan->amount;
                    $loan->amount=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $loan->amount), 0, -2);
                    if ($loan->amount==0) {
                        $loan->amount=$postamount;
                    }
                    $loan->save();
                //print_r($loan->getErrors());exit;
                } else {
                    $loan->delete();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }
        \Yii::$app->session['project_progress_save']=ProjectProgression::find()->where(['project_id'=>$id])->orderBy('project_year DESC')->all();
        return $this->render('update', [
            'model' => $model,
            'loan'=>$loan
        ]);
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionProjectprocesscreate()
    {
        if (!empty($_GET['progress_id'])) {
            $progress_id=$_GET['progress_id'];
            $model=ProjectProgression::find()->where(['id'=>(int)$_GET['progress_id']])->one();
        } else {
            $progress_id=null;
            $model=new ProjectProgression();
        }

        if (isset($_POST['year'])) {
            $postproposal_amount=$_POST['amount_proposal'];
            $model->proposal_amount=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['amount_proposal']), 0, -2);
            if ($model->proposal_amount==0) {
                $model->proposal_amount=$postproposal_amount;
            }

            $postamount_approved=$_POST['amount_approved'];
            $model->aproved_amount=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['amount_approved']), 0, -2);
            if ($model->aproved_amount==0) {
                $model->aproved_amount=$postamount_approved;
            }

            $postamount_approved_oda=$_POST['amount_approved_oda'];
            $model->aproved_amount_oda=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['amount_approved_oda']), 0, -2);
            if ($model->aproved_amount_oda==0) {
                $model->aproved_amount_oda=$postamount_approved_oda;
            }

            $model->project_status_id=$_POST['status'];
            $model->project_year=$_POST['year'];
            if (!empty(Yii::$app->session['project_id'])) {
                unset(\Yii::$app->session['project_progress']);
                $model->project_id=(int)$_POST['project_id'];
                $model->save();
                \Yii::$app->session['project_progress_save']=ProjectProgression::find()->where(['project_id'=>$model->project_id])->orderBy('project_year DESC')->all();
            } else {
                \Yii::$app->session['project_progress']=$model;
            }
            return $this->renderAjax('list_project_progess');
        } else {
            if (!empty(\Yii::$app->session['project_progress'])) {
                $model=\Yii::$app->session['project_progress'];
            }
            return $this->renderAjax('form_project_process', ['model'=>$model,'progress_id'=>$progress_id]);
        }
    }

    public function actionDelprojectprogress($id, $project_id)
    {
        if (isset($_GET['dels'])) {
            unset(\Yii::$app->session['project_progress']);
        } else {
            $model=ProjectProgression::find()->where(['id'=>$id])->one();
            $model->delete();
            \Yii::$app->session['project_progress_save']=ProjectProgression::find()->where(['project_id'=>$project_id])->orderBy('project_year DESC')->all();
        }
        return $this->renderAjax('list_project_progess');
    }

    public function actionProjectpay()
    {
        if (isset($_GET['progress_id'])&& isset($_GET['timespay'])) {
            Yii::$app->session['progress_id']=$_GET['progress_id'];
            Yii::$app->session['timespay']=$_GET['timespay'];
        }
        if (Yii::$app->session['timespay']==1) {
            $type='first_six_months';
        } else {
            $type='full_year';
        }
        $model=ProjectPayment::find()->where(['project_progression_id'=>Yii::$app->session['progress_id'],'payment_type'=>$type])->one();
        if (empty($model)) {
            $model=new ProjectPayment;
        }
        $projectprogress=ProjectProgression::find()->where(['id'=>(int)$_GET['progress_id']])->one();
        if (isset($_POST['amount'])) {
            $postamount=$_POST['amount'];
            $model->amount=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['amount']), 0, -2);
            if ($model->amount==0) {
                $model->amount=$postamount;
            } 

            $model->is_oda=$_POST['is_oda'];
            $model->payment_type=$type;
            $model->project_progression_id=Yii::$app->session['progress_id'];
            $model->save();
            return $this->renderAjax('list_project_progess');
        }
        return $this->renderAjax('form_project_payment', ['projectprogress'=>$projectprogress,'model'=>$model,'timespay'=>$_GET['timespay']]);
    }

    public function actionReportplan()
    {
        $this->layout="main_report";
        if(isset($_POST['csv']) && isset($_POST['export']))
        {
            $name='​investment sheet_'.date('Y-m-d').'.xls';
            header('Content-Type: application/force-download');
            header('Content-disposition: attachment; filename='.$name.'');
            // Fix for crappy IE bug in download.
            header("Pragma: ");
            header("Cache-Control: ");
            return $_POST['csv'];
        }
        return $this->render('reportplan');
    }

    public function actionReportsummary()
    {
        $this->layout="main_report";
        return $this->render('reportsummary');
    }
}