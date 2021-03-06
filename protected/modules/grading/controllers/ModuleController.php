<?php

class ModuleController extends Controller
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
				'actions'=>array('index','view','admin'),
				'roles'=>array('1','2','3'),
			),
                    array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('student','viewstudent','AssignView'),
				'roles'=>array('0'),
			),
                    /*
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
                     * 
                     */
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
             $criteria=new CDbCriteria;
                $criteria->addCondition('unitid=:value');
                $criteria->params=array(':value'=>$id);
                if(Yii::app()->user->checkAccess('2'))
                $criteria->addInCondition('status',array('Pending','NotOpened','Opened'));
                if(Yii::app()->user->checkAccess('3'))
                $criteria->addInCondition('status',array('NotOpened','Opened'));
                
                $assingment = new CActiveDataProvider("Assignment",array('criteria'=>$criteria));
                
                unset(Yii::app()->session['module_id']);
                Yii::app()->session['module_id'] = $id;
                
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                    'assignment'=>$assingment,
		));
	}

        public function actionViewstudent($id)
	{
            
            $criteria=new CDbCriteria;
                $criteria->condition='unitid=:value';
                $criteria->params=array(':value'=>$id);
                $criteria->addInCondition('status',array('Opened'));
                $assingment = new CActiveDataProvider("Assignment",array('criteria'=>$criteria));
                
                unset(Yii::app()->session['module_id']);
                Yii::app()->session['module_id'] = $id;
                
		$this->render('moduleviewstudent',array(
			'model'=>$this->loadModel($id),
                        'assignment'=>$assingment,
		));
	}
        
        public function actionAssignView($id)
	{
            $assignment = Assignment::model()->findByPk($id);
            $coursework=  CourseWork::model()->findByAttributes(array('assign_id'=>$assignment->mngid));
               unset(Yii::app()->session['assign_id']);
                Yii::app()->session['assign_id'] = $id;
		$this->render('studentassign',array(
			'model'=>$assignment,
                        'coursework'=>$coursework,
                       
		));
	}
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Module;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Module']))
		{
			$model->attributes=$_POST['Module'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->SerialOrder));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Module']))
		{
			$model->attributes=$_POST['Module'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->SerialOrder));
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
            $criteria=new CDbCriteria;
            if(Yii::app()->user->checkAccess(3)||Yii::app()->user->checkAccess(2)){
             if(Yii::app()->session['course_id']==null)
                    throw new CHttpException(404,'No course specified. Please Select a course');
             
             $criteria->condition='CourseNo=:value';
                $criteria->params=array(':value'=>Yii::app()->session['course_id']); 
            }    
            if(Yii::app()->user->checkAccess(1)){
                $criteria=new CDbCriteria;
                $criteria->join='LEFT JOIN professor ON professor.module_id=t.SerialOrder';
                $criteria->condition='professor.professor=:value';
                $criteria->params=array(':value'=>Yii::app()->user->id); 
                }
		$dataProvider=new CActiveDataProvider('Module',array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Module('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Module']))
			$model->attributes=$_GET['Module'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        public function actionStudent()
	{
             $student = Student::model()->findByPk(Yii::app()->user->id);
            $criteria=new CDbCriteria;
                $criteria->condition='CourseNo=:value';
                $criteria->params=array(':value'=>$student->CourseNo);
                $model = new CActiveDataProvider("Module",array('criteria'=>$criteria));
	
                
              //  $notification=  Notification::model()->findAllByAttributes(array('student_id'=>$student->EdHatNo));
              //  Yii::app()->session['notifications']=  sizeof($notification);
                $this->render('modulestudent',array(
			'model'=>$model,
                       // 'notifications'=> $notification,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Module the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
            
            if(Yii::app()->user->checkAccess(3)||Yii::app()->user->checkAccess(2)){
             if(Yii::app()->session['course_id']==null)
                    throw new CHttpException(404,'No course specified. Please Select a course');
             
              $model=Module::model()->findByAttributes(array('SerialOrder'=>$id,'CourseNo'=>Yii::app()->session['course_id']));
               
            }    
          else  if(Yii::app()->user->checkAccess(1)){
                $prof=  Professor::model()->findByAttributes(array('module_id'=>$id,'professor'=>Yii::app()->user->id));
              if($prof===null)
                  throw new CHttpException(404,'The requested page does not exist');
              $model=Module::model()->findByPk($id);
             }
                
            else if(Yii::app()->user->checkAccess(0)){
                $student= Student::model()->findByPk(Yii::app()->user->id);
              $model=Module::model()->findByAttributes(array('SerialOrder'=>$id,'CourseNo'=>$student->CourseNo));
             }
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                else
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Module $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='module-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
