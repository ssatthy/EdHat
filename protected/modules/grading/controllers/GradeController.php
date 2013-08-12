<?php

class GradeController extends Controller
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
				'actions'=>array('index','view','notification'),
				'roles'=>array('0','1','2','3'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
				'roles'=>array('1','2','3'),
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
                $criteria->condition='grade_id=:value';
                $criteria->params=array(':value'=>$id);
                $gradings = new CActiveDataProvider("Gradecolumn",array('criteria'=>$criteria));
            
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'gradings'=>$gradings,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
       
		$model=new Grade;
                $columns=new Gradecolumn;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Grade']))
		{
                    $assignment = Assignment::model()->findByPk($id);
			$model->attributes=$_POST['Grade'];
                        $model->assign_id=$assignment->id;
                        $model->student_id=$assignment->student_id;
                        $model->verifier_id=Yii::app()->user->id;
                        if(isset($_POST['field'])) {
                                $columns->grade_id=$model->id;
                                $columns->field=$_POST['field'];
                                $columns->marks=$_POST['marks'];
                                $columns->description=$_POST['description'];
                        
			if($model->save()&&sizeof($columns->field)!=0){
                            
                               for($i=0;$i < sizeof($columns->field); $i++){
                                   $singlecolumn=new Gradecolumn;
                                   $singlecolumn->grade_id=$model->id;
                                   $singlecolumn->field=$columns->field[$i];
                                   $singlecolumn->marks=$columns->marks[$i];
                                   $singlecolumn->description=$columns->description[$i];
                                  $singlecolumn->save();
                                  } 
                                  $notification=new Notification;
                                  $notification->grade_id=$model->id;
                                  $notification->assign_id=$model->assign_id;
                                  $notification->student_id=$model->student_id;
                                  if($notification->save())
                                    $this->redirect(array('view','id'=>$model->id));
                                }
                                else
                                    throw new CHttpException('Nothing was submitted :(');
                        }
				
		}

		$this->render('create',array(
			'model'=>$model,
                    'columns'=>$columns,
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

		if(isset($_POST['Grade']))
		{
			$model->attributes=$_POST['Grade'];
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
		$dataProvider=new CActiveDataProvider('Grade');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Grade('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Grade']))
			$model->attributes=$_GET['Grade'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        public function actionNotification()
        {
            $notification=  Notification::model()->findAllByAttributes(array('student_id'=>Yii::app()->user->id));
            $assignments  =array();
            for($i=0;$i<count($notification);$i++){
                $assignments[$i]=  Assignment::model()->findByPk($notification[$i]->assign_id);
                 } 
            $this->render('notification',array(
                'notifications'=>$notification,
                'assignments'=>$assignments,
                ));
            for($i=0;$i<count($notification);$i++)
            $notification[$i]->delete();
        }

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Grade the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Grade::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Grade $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='grade-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
