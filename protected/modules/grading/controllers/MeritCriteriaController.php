<?php

class MeritCriteriaController extends Controller
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
				'actions'=>array('create','update','AddMeritCriteriaItem'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
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
                 $criteria=new CDbCriteria;
                $criteria->condition='meritc_id=:value';
               $criteria->params=array(':value'=>$id);
                $merit_criteria_item = new CActiveDataProvider("MeritCriteriaItem",array('criteria'=>$criteria));
                
            
            $this->render('view',array(
			'model'=>$this->loadModel($id),
                        'merit_cri_items'=>$merit_criteria_item,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MeritCriteria;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MeritCriteria']))
		{
			$model->attributes=$_POST['MeritCriteria'];
                         $model->unit_id=Yii::app()->session['module_id'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        
        public function actionAddMeritCriteriaItem()
        {
            $meritCriteriaItems = new MeritCriteriaItem();
         
               if(isset($_POST['item_no'])) {
                                $meritCriteriaItems-> meritc_id=$_POST['meritc_id'];
                                $meritCriteriaItems->item_no=$_POST['item_no'];
                                $meritCriteriaItems->title=$_POST['title'];
                        if( sizeof($meritCriteriaItems->item_no)>0){
                            $success=false;
                               for($i=0;$i < sizeof($meritCriteriaItems->item_no); $i++){
                                  
                                   $item=new MeritCriteriaItem;
                                   
                                   $item->meritc_id=$meritCriteriaItems->meritc_id[$i];
                                   $item->item_no=$meritCriteriaItems->item_no[$i];
                                   $item->title=$meritCriteriaItems->title[$i];
                                   
                                  if($item->save())
                                      $success=true;
                                  
                                  } 
                                  if($success){
                                      
                                  $this->redirect(array('meritcriteria/admin'));}
                                  else
                                    throw new CHttpException('Nothing was submitted :(');
                                }
                                else
                                    throw new CHttpException('Nothing was submitted :(');
                        }
                      
           
            $this->render('add_merit_item',array(
			
                        'criteriaitems'=>$meritCriteriaItems,
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

		if(isset($_POST['MeritCriteria']))
		{
			$model->attributes=$_POST['MeritCriteria'];
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
		$dataProvider=new CActiveDataProvider('MeritCriteria');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MeritCriteria('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MeritCriteria']))
			$model->attributes=$_GET['MeritCriteria'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MeritCriteria the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MeritCriteria::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MeritCriteria $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='merit-criteria-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
