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
use PHPExcel;
use PHPExcel_IOFactory;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Department;
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
            Yii::$app->session['syear']=$model->submit_year;
            Yii::$app->session['department_id']=$model->department_id;
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

    public function actionExcel() {
        // Create new PHPExcel object
         $objPHPExcel = new PHPExcel();

         $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');

         $objPHPExcel->getDefaultStyle()->applyFromArray(array('font' => array('name'  => 'Saysettha OT')));
        
         $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('0acae5');
         $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold( true );
        
         // Add some data
        $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a1c4c4');
        $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold( true );

        //// get total amount project All by year
        $total_by_year=ProjectProposal::find()->joinWith('projectProposalYear')
        ->where(['submit_year'=>Yii::$app->session['syear']])
        ->sum('amount');
        if(Yii::$app->user->identity->type !="Admin" && $total_by_year>0)
        {
            $total_by_year='';
        }
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getNumberFormat()->setFormatCode('#,##0.00');

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', Yii::t('app','ບົດ​ສະ​ເໜີ​ໂຄງ​ການ​ຂອງ​ປີ:').Yii::$app->session['syear'])
        ->setCellValue('F1', $total_by_year)
        ->setCellValue('A2', Yii::t('app','ລ/ດ'))
        ->setCellValue('B2', Yii::t('app','ຊື່​​ໂຄງ​ການ'))
        ->setCellValue('C2', Yii::t('app','ສະ​ຖາ​ນະ'))
        ->setCellValue('D2', Yii::t('app','​ປີ​ເລີ່ມ'))
        ->setCellValue('E2', Yii::t('app','​​ປີ​ສີ້ນ​ສຸດ'))
        ->setCellValue('F2', Yii::t('app','​ຈຳ​ນວນ​ເງີນ/​ລ້ານ​ກີບ'));

        /// getdata from database
        $departments=Department::find()->where(['in', 'id', Yii::$app->session['department_id']])->all();
        $i=2;
        foreach($departments as $department)
        {
            $i++;
            /// Mergeclell
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':E'.$i.'');
           //// backgroud cell
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('eff5f5');
            /// font bold
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold( true );
           
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $department->department_name);
           
            //// get total amount project by department
            $total_by_department=ProjectProposal::find()->joinWith('projectProposalYear')
            ->where(['department_id'=>$department->id])
            ->andWhere(['submit_year'=>Yii::$app->session['syear']])
            ->sum('amount');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('c8d4c1');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold( true );
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $total_by_department,2);

            $proposalyear =ProjectProposalYear::find()->where(['department_id'=>$department->id])->andWhere(['submit_year'=>Yii::$app->session['syear']])->one();
            if(!empty($proposalyear))
            {
                $proposals=ProjectProposal::find()->where(['project_proposal_year_id'=>$proposalyear->id])->all();
                $a=$i;
                $r=0;
                foreach($proposals as $proposal)
                {
                    $a++;
                    $r++;
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $a, $r);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $a, $proposal->project_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $a, $proposal->code_old_project);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $a, $proposal->start_year);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $a, $proposal->end_year);

                    $objPHPExcel->getActiveSheet()->getStyle('F'.$a)->getNumberFormat()->setFormatCode('#,##0.00');
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $a, $proposal->amount);
                }
                $i=$a;
            }else{
                $i=$i+1;
                $objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':E'.$i.'');
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, Yii::t('app', '​ຍັງບໍ່​ມີ​ບົດ​ສະ​ເໜີ​ໂຄງ​ການ'));
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('reportexternal.xlsx'); // Save File
        Yii::$app->response->sendFile(Yii::$app->basePath . '/web/reportexternal.xlsx');
       
    }
}
