<?php

class CenterController extends Controller
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
				'roles'=>array('2','3'),
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
                $criteria->select = 't.*';
                $criteria->join='LEFT JOIN center_course ON center_course.CourseIndex=t.CourseIndex';
                $criteria->condition='center_course.centerid=:value';
                $criteria->params=array(':value'=>$id);
                $courses = new CActiveDataProvider("Course",array('criteria'=>$criteria));
                
                unset(Yii::app()->session['center_id']);
                Yii::app()->session['center_id'] = $id;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'courses'=>$courses,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Center;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Center']))
		{
			$model->attributes=$_POST['Center'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->centerid));
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

		if(isset($_POST['Center']))
		{
			$model->attributes=$_POST['Center'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->centerid));
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
            if(Yii::app()->user->checkAccess(3)){
                if(Yii::app()->session['country_id']==null)
                    throw new CHttpException(404,'No country specified. Please select a country');
                $criteria->condition='country_id=:value';
                $criteria->params=array(':value'=>Yii::app()->session['country_id']);
                
            }
            if(Yii::app()->user->checkAccess(2)){
                $criteria->join='LEFT JOIN int_supervisor ON int_supervisor.center_id=t.centerid';
                $criteria->condition='int_supervisor.intsupervisor=:value';
                $criteria->params=array(':value'=>Yii::app()->user->id);  
            }
            
		$dataProvider=new CActiveDataProvider('Center',  array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Center('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Center']))
			$model->attributes=$_GET['Center'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Center the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
            $criteria=new CDbCriteria;
           
            if(Yii::app()->user->checkAccess(3)){
                if(Yii::app()->session['country_id']==null)
                    throw new CHttpException(404,'No country specified. Please select a country');
                $model=Center::model()->findByAttributes(array('centerid'=>$id,'country_id'=>Yii::app()->session['country_id']));
                
            }
            if(Yii::app()->user->checkAccess(2)){
                $intsup=  IntSupervisor::model()->findByPk(array('intsupervisor'=>Yii::app()->user->id,'center_id'=>$id)); 
                if($intsup!==null)
                    $model=Center::model()->findByPk($id);
                else
                    throw new CHttpException(404,'The requested page does not exist.');}
            
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                else
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Center $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='center-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
