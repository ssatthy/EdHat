<?php

class CourseWorkController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','DownloadFile','ApproveCourseWork'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CourseWork;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CourseWork']))
		{
                    $model->attributes=$_POST['CourseWork'];
                    $model->source_file=CUploadedFile::getInstance($model,'source_file');
                        $model->student_id=Yii::app()->user->id;
                        $model->assign_id=Yii::app()->session['assign_id'];
                        $model->source_file_path='/protected/documents/'.Yii::app()->user->id.'/'.$model->assign_id.'_'.$model->source_file->name;
			if($model->save()){
                            if (!file_exists(Yii::getPathOfAlias('webroot'). '/protected/documents/'.Yii::app()->user->id)) {
                                mkdir(Yii::getPathOfAlias('webroot'). '/protected/documents/'.Yii::app()->user->id);
                                }
                            $model->source_file->saveAs(Yii::getPathOfAlias('webroot') . '/protected/documents/'.Yii::app()->user->id.'/'.$model->assign_id.'_'.$model->source_file->name);
				$this->redirect(array('/grading/module/AssignView','id'=>$model->assign_id));
                }
                
                        }

		$this->render('create',array(
			'model'=>$model,
		));
	}

        public function actionDownloadFile($id)
            {
              $model=$this->loadModel($id);
              $assignment=  Assignment::model()->findByPk($model->assign_id);
              $soursefile = Yii::app()->file->set(Yii::getPathOfAlias('webroot') . $model->source_file_path, true); 
              if($soursefile->exists &&($model->student_id==Yii::app()->user->id ||
                      Yii::app()->user->checkAccess('1') ||Yii::app()->user->checkAccess('2')
                      ||Yii::app()->user->checkAccess('3'))){
                  $fextention = explode(".", $model->source_file_path);
                      $soursefile->send($assignment->assign_no.'_'.$assignment->title.'.'.$fextention[1], false); }
              else {
                  throw new CHttpException(404,'The requested file does not exist.');
              }
            }
            
            
            public function actionApproveCourseWork($id){
                $status=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                if(Yii::app()->user->role==1){
                    if($status->prof_pass=='failed'
                            ||($status->prof_pass=='passed' && $status->prof_merit=='failed')
                            ||($status->prof_pass=='passed' && $status->prof_merit=='passed' && $status->prof_merit=='failed' )
                            ||($status->prof_pass=='passed' && $status->prof_merit=='passed' && $status->prof_merit=='passed' )){
                        if($status->prof_task=='OK'){
                            $status->isNewRecord=false;
                            $status->prof_approved='OK';
                            $status->save();
                            Yii::app()->user->setFlash('success','This course work has been approved!');
                            $this->redirect(array('Assignment/CourseWorkView','id'=>$id));
                        }
                        else{
                           Yii::app()->user->setFlash('error','OOPS! </br> Marks have not been given correctly for tasks </br> Please edit the marks!' );
                            $this->redirect(array('Assignment/CourseWorkView','id'=>$id)); 
                        }
                            
                       }
                    else
                    {
                      Yii::app()->user->setFlash('error','OOPS! </br> Criterias have not been marked correctly </br> Please make it correct, then try!' );
                            $this->redirect(array('Assignment/CourseWorkView','id'=>$id));   
                    }
                }
                
                 elseif(Yii::app()->user->role==2){
                    if($status->int_pass=='failed'
                            ||($status->int_pass=='passed' && $status->int_merit=='failed')
                            ||($status->int_pass=='passed' && $status->int_merit=='passed' && $status->int_merit=='failed' )
                            ||($status->int_pass=='passed' && $status->int_merit=='passed' && $status->int_merit=='passed' )){
                        if($status->int_task=='OK'){
                            $status->isNewRecord=false;
                            $status->int_approved='OK';
                            $status->save();
                            Yii::app()->user->setFlash('success','This course work has been approved!');
                            $this->redirect(array('Assignment/CourseWorkView','id'=>$id));
                        }
                        else{
                           Yii::app()->user->setFlash('error','OOPS! </br> Marks have not been given correctly for tasks </br> Please edit the marks!' );
                            $this->redirect(array('Assignment/CourseWorkView','id'=>$id)); 
                        }
                            
                       }
                    else
                    {
                      Yii::app()->user->setFlash('error','OOPS! </br> Criterias have not been marked correctly </br> Please make it correct, then try!' );
                            $this->redirect(array('Assignment/CourseWorkView','id'=>$id));   
                    }
                }
                 elseif(Yii::app()->user->role==3){
                    if($status->ext_pass=='failed'
                            ||($status->ext_pass=='passed' && $status->ext_merit=='failed')
                            ||($status->ext_pass=='passed' && $status->ext_merit=='passed' && $status->ext_merit=='failed' )
                            ||($status->ext_pass=='passed' && $status->ext_merit=='passed' && $status->ext_merit=='passed' )){
                        if($status->ext_task=='OK'){
                            $status->isNewRecord=false;
                            $status->ext_approved='OK';
                            $status->save();
                            Yii::app()->user->setFlash('success','This course work has been approved!');
                            $this->redirect(array('Assignment/CourseWorkView','id'=>$id));
                        }
                        else{
                           Yii::app()->user->setFlash('error','OOPS! </br> Marks have not been given correctly for tasks </br> Please edit the marks!' );
                            $this->redirect(array('Assignment/CourseWorkView','id'=>$id)); 
                        }
                            
                       }
                    else
                    {
                      Yii::app()->user->setFlash('error','OOPS! </br> Criterias have not been marked correctly </br> Please make it correct, then try!' );
                            $this->redirect(array('Assignment/CourseWorkView','id'=>$id));   
                    }
                }
               
            }

            /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CourseWork']))
		{
			$model->attributes=$_POST['CourseWork'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CourseWork');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CourseWork('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CourseWork']))
			$model->attributes=$_GET['CourseWork'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CourseWork the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CourseWork::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CourseWork $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='course-work-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
