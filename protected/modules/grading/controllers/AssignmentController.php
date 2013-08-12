<?php

class AssignmentController extends Controller
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
				'actions'=>array('view','index'),
				'roles'=>array('0','1','2','3'),
			),
                    array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('DownloadFile'),
				'roles'=>array('0','1','2','3'),
			),
                    array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('create','update','delete'),
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
            $grades = Grade::model()->findAllByAttributes(array('assign_id'=>$id));
                   
             $gradecolumns  =array();
            for($i=0;$i<count($grades);$i++){
                $criteria=new CDbCriteria;
                $criteria->condition='grade_id=:value';
               $criteria->params=array(':value'=>$grades[$i]->id);
                $gradecolumns[$i] = new CActiveDataProvider("gradecolumn",array('criteria'=>$criteria));
                
            } 
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'gradecolumns'=>$gradecolumns,
                        'gradesby'=>$grades,
                        
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Assignment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Assignment']))
		{
			$model->attributes=$_POST['Assignment'];
                        $model->source=CUploadedFile::getInstance($model,'source');
                        $model->student_id=Yii::app()->user->id;
                        $model->source_file_path='/protected/documents/'.Yii::app()->user->id.'/'.$model->serial_order.'_'.$model->assign_no.'_'.$model->source->name;
			if($model->save()){
                            if (!file_exists(Yii::getPathOfAlias('webroot'). '/protected/documents/'.Yii::app()->user->id)) {
                                mkdir(Yii::getPathOfAlias('webroot'). '/protected/documents/'.Yii::app()->user->id);
                                }
                            $model->source->saveAs(Yii::getPathOfAlias('webroot') . '/protected/documents/'.Yii::app()->user->id.'/'.$model->serial_order.'_'.$model->assign_no.'_'.$model->source->name);
				$this->redirect(array('view','id'=>$model->id));
                }
                
                        }

		$this->render('create',array(
			'model'=>$model,
		));
	}

        public function actionDownloadFile($id)
            {
              $model=$this->loadModel($id);
              $soursefile = Yii::app()->file->set(Yii::getPathOfAlias('webroot') . $model->source_file_path, true); 
              if($soursefile->exists &&($model->student_id==Yii::app()->user->id ||
                      Yii::app()->user->checkAccess('1') ||Yii::app()->user->checkAccess('2')
                      ||Yii::app()->user->checkAccess('3')))
                  
                 $soursefile->send($model->assign_no.'_'.$model->assign_name, false);
              else {
                  throw new CHttpException(404,'The requested file does not exist.');
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

		if(isset($_POST['Assignment']))
		{
			$model->attributes=$_POST['Assignment'];
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
            $criteria=new CDbCriteria;
                $criteria->select = '*';
                $criteria->condition='t.student_id=:value';
                $criteria->params=array(':value'=>Yii::app()->user->id);
                
		$dataProvider=new CActiveDataProvider('Assignment',array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Assignment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Assignment']))
			$model->attributes=$_GET['Assignment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Assignment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
            if(Yii::app()->user->checkAccess(3)||Yii::app()->user->checkAccess(2)){
             if(Yii::app()->session['course_id']==null||Yii::app()->session['module_id']==null)
                    throw new CHttpException(404,'No course or module specified. Please Select a course and module');
             
              $module=Module::model()->findByAttributes(array('SerialOrder'=>Yii::app()->session['module_id'],'CourseNo'=>Yii::app()->session['course_id']));
               $model=Assignment::model()->findByAttributes(array('id'=>$id,'serial_order'=>$module->SerialOrder));
            }    
          else  if(Yii::app()->user->checkAccess(1)){
              if(Yii::app()->session['module_id']==null)
                    throw new CHttpException(404,'No module specified. Please Select a module');
              
                $model=Assignment::model()->findByAttributes(array('id'=>$id,'serial_order'=>Yii::app()->session['module_id']));
             
             }
                
            else if(Yii::app()->user->checkAccess(0)){
                $model=Assignment::model()->findByAttributes(array('id'=>$id,'student_id'=>Yii::app()->user->id));
             }
            
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                else
		return $model;
	}
            //get list of modules that user has entrolled
        public function getModuleList(){
            $student = Student::model()->findByPk(Yii::app()->user->id);
		$proflist = CHtml::listData(Module::model()->findAllByAttributes(array('CourseNo' => $student->CourseNo)),'SerialOrder','ModuleName');
		return $proflist;
	}
        
	/**
	 * Performs the AJAX validation.
	 * @param Assignment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='assignment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
