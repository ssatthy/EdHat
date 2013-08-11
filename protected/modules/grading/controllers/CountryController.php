<?php

class CountryController extends Controller
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
				'roles'=>array('3'),
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
                $criteria->condition='country_id=:value';
                $criteria->params=array(':value'=>$id);
                $centers = new CActiveDataProvider("Center",array('criteria'=>$criteria));
                
                //create a session variable for county for later use
               unset(Yii::app()->session['country_id']);
                Yii::app()->session['country_id'] = $id;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'centers'=>$centers,
		));
                
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Country;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Country']))
		{
			$model->attributes=$_POST['Country'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->country_id));
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

		if(isset($_POST['Country']))
		{
			$model->attributes=$_POST['Country'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->country_id));
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
                $criteria->select = 't.*';
                $criteria->join='LEFT JOIN ext_supervisor ON ext_supervisor.country_id=t.country_id';
                $criteria->condition='ext_supervisor.extsupervisor=:value';
                $criteria->params=array(':value'=>Yii::app()->user->id);
                
		$dataProvider=new CActiveDataProvider('Country',  array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Country('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Country']))
			$model->attributes=$_GET['Country'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Country the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Country::model()->findByPk($id);
                $extcontry=  ExtSupervisor::model()->findByPk(array('extsupervisor'=>Yii::app()->user->id, 'country_id'=>$id));
		if($model===null ||$extcontry===null)
			throw new CHttpException(404,'The requested page does not exist.');
                else
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Country $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='country-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
