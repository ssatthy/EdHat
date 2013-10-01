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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','addpasscriteriaitem','addtask','addsubtask','SubmitAssignment','GradePassCriteria'),
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
            $assignment = $this->loadModel($id);
            unset(Yii::app()->session['assign_id']);
                Yii::app()->session['assign_id'] = $id;
                
             if($assignment->status=='Opened'){
                 $criteria=new CDbCriteria;
                $criteria->addCondition('assign_id=:value');
               $criteria->params=array(':value'=>$assignment->mngid);
                $courseworks = new CActiveDataProvider("CourseWork",array('criteria'=>$criteria));
                $this->render('course_worklist',array(
			'model'=>$assignment,
                        'courseworks'=>$courseworks,
                       
		));
             }
            elseif($assignment->status=='NotFinished'&&Yii::app()->user->checkAccess('1'))
                $this->assignmentview($assignment);
                
            elseif($assignment->status=='Pending' && Yii::app()->user->checkAccess('1'))
                $this->render('view',array(
			'model'=>$assignment,
                       
		));
            
                elseif ($assignment->status=='Pending' && Yii::app()->user->checkAccess('2'))
             $this->assignmentview($assignment);
           elseif($assignment->status=='NotOpened' && Yii::app()->user->checkAccess('2'))
                $this->render('view',array(
			'model'=>$assignment,
                       
		));
           
           elseif ($assignment->status=='NotOpened' && Yii::app()->user->checkAccess('3'))
             $this->assignmentview($assignment);
         
            
 }

        public function assignmentview($assignment)
        {
            $pass_criteria = PassCriteria::model()->findAllByAttributes(array('unit_id'=>$assignment->unitid));
            $pass_cri_items  =array();
            for($i=0;$i<count($pass_criteria);$i++){
                 $criteria=new CDbCriteria;
                $criteria->addCondition('pass_id=:value');
                $criteria->addCondition('assign_id=:value1');
               $criteria->params=array(':value'=>$pass_criteria[$i]->id,':value1'=>$assignment->mngid);
                $pass_cri_items[$i] = new CActiveDataProvider("PassCriteriaItem",array('criteria'=>$criteria));
                
            }
             $tasks = Task::model()->findAllByAttributes(array('assign_id'=>$assignment->mngid));
            $subtasks=array();
            for($i=0;$i<count($tasks);$i++){
                 $criteria=new CDbCriteria;
                $criteria->condition='task_id=:value';
               $criteria->params=array(':value'=>$tasks[$i]->id);
                $subtasks[$i] = new CActiveDataProvider("Subtask",array('criteria'=>$criteria));
                
            }
            
		$this->render('review_view',array(
			'model'=>$assignment,
                        'pass_criteria'=>$pass_criteria,
                        'pass_cri_items'=>$pass_cri_items,
                        'tasks'=>$tasks,
                        'subtasks'=>$subtasks,
		));
            }
            
            public function actionGradePassCriteria($id)
            {
                $passgrade = new PcriteriaGrade();
                 $item = new PcriteriaGrade();
                if(isset($_POST['PcriteriaGrade']))
                    {
                   
                        $valid=true;
                        for($i=0;$i<sizeof($_POST['PcriteriaGrade']);$i++)
                        {
                            if(isset($_POST['PcriteriaGrade'][$i])){
                                $item->attributes=$_POST['PcriteriaGrade'][$i];
                           // $valid=$item->validate() && $valid;
                            
                        }
                       echo 'func'.sizeof($_POST['PcriteriaGrade']); die();
                    }
                    }
                
                $coursework=  CourseWork::model()->findByPk($id);
                $assignment = Assignment::model()->findByPk($coursework->assign_id);
                $passcriteria = PassCriteria::model()->findAllByAttributes(array('unit_id'=>$assignment->unitid));
                
                $criteria_items= array();
                for($x=0;$x<sizeof($passcriteria);$x++){
                    $criteria=new CDbCriteria;
                $criteria->addCondition('pass_id=:value');
                $criteria->addCondition('assign_id=:value1');
               $criteria->params=array(':value'=>$passcriteria[$x]->id,':value1'=>$assignment->mngid);
                $criteria_items[$x] = new CActiveDataProvider("PassCriteriaItem",array('criteria'=>$criteria));
                }
                $this->render('/grade/grade_criteria',array(
			'model'=>$assignment,
                        'criteria'=>$passcriteria,
                        'criteriaitem'=>$criteria_items,
                        'grades'=>$passgrade,
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
                        $model->unitid=Yii::app()->session['module_id'];
                        $model->status='NotFinished';
			if($model->save())
				$this->redirect(array('view','id'=>$model->mngid));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        public function actionSubmitAssignment($id)
        {
            $assign=  Assignment::model()->findByPk($id);
            if(Yii::app()->user->checkAccess('1'))
            $assign->status='Pending';
            if(Yii::app()->user->checkAccess('2'))
            $assign->status='NotOpened';
            if(Yii::app()->user->checkAccess('3'))
            $assign->status='Opened';
            if($assign->save())
		$this->redirect(array('view','id'=>$assign->mngid));
        }


        public function actionAddPassCriteriaItem($id)
        {
            $passCriteriaItems = new PassCriteriaItem();
            
               if(isset($_POST['item_no'])) {
                                $passCriteriaItems-> pass_id=$_POST['pass_id'];
                                $passCriteriaItems->item_no=$_POST['item_no'];
                                $passCriteriaItems->title=$_POST['title'];
                        if( sizeof($passCriteriaItems->item_no)>0){
                            $success=false;
                               for($i=0;$i < sizeof($passCriteriaItems->item_no); $i++){
                                   $success=false;
                                   $item=new PassCriteriaItem;
                                   $item->assign_id=$id;
                                   $item->pass_id=$passCriteriaItems->pass_id[$i];
                                   $item->item_no=$passCriteriaItems->item_no[$i];
                                   $item->title=$passCriteriaItems->title[$i];
                                   
                                  if($item->save())
                                      $success=true;
                                  
                                  } 
                                  if($success)
                                  $this->redirect(array('assignment/view','id'=>$id));
                                  else
                                    throw new CHttpException('Nothing was submitted :(');
                                }
                                else
                                    throw new CHttpException('Nothing was submitted :(');
                        }
                      
           
            $this->render('add_pass_items',array(
			'model'=>$this->loadModel($id),
                        'criteriaitems'=>$passCriteriaItems,
		));
            
        }
        
        public function actionAddTask($id)
        {
           
            $task = new Task();
            
                 if(isset($_POST['task_no'])) {
                                $task->lo_id=$_POST['lo_id'];
                                $task->task_no=$_POST['task_no'];
                                
                        if( sizeof($task->task_no)>0){
                            $success=false;
                               for($i=0;$i < sizeof($task->task_no); $i++){
                                   $success=false;
                                   $item=new Task();
                                   $item->assign_id=$id;
                                   $item->lo_id=$task->lo_id[$i];
                                   $item->task_no=$task->task_no[$i];
                                   
                                  if($item->save())
                                      $success=true;
                                  
                                  } 
                                  if($success)
                                  $this->redirect(array('assignment/view','id'=>$id));
                                  else
                                    throw new CHttpException('Nothing was submitted :(');
                                }
                                else
                                    throw new CHttpException('Nothing was submitted :(');
                        }
                        
           
            $this->render('add_task',array(
			'model'=>$this->loadModel($id),
                        'task'=>$task,
		));
            
        }

        public function actionAddsubtask($id)
        {
            $subtask = new Subtask();
                 if(isset($_POST['sub_no'])) {
                                $subtask->task_id=$_POST['task_id'];
                                $subtask->sub_no=$_POST['sub_no'];
                                $subtask->title=$_POST['title'];
                                $subtask->max_marks=$_POST['max_marks'];
                                $subtask->pass_crit_item_id=$_POST['pass_crit_item_id'];
                                
                                
                        if( sizeof($subtask->task_id)>0){
                            $success=false;
                               for($i=0;$i < sizeof($subtask->task_id); $i++){
                                   $success=false;
                                   $item=new Subtask();
                                   $item->task_id=$subtask->task_id[$i];
                                   $item->sub_no=$subtask->sub_no[$i];
                                   $item->title=$subtask->title[$i];
                                   $item->max_marks=$subtask->max_marks[$i];
                                   $item->pass_crit_item_id=$subtask->pass_crit_item_id[$i];
                                   
                                  if($item->save())
                                      $success=true;
                                  
                                  } 
                                  if($success)
                                  $this->redirect(array('assignment/view','id'=>$id));
                                  else
                                    throw new CHttpException('Nothing was submitted :(');
                                }
                                else
                                    throw new CHttpException('Nothing was submitted :(');
                        }
                        
           
            $this->render('add_subtask',array(
			'model'=>$this->loadModel($id),
                        'subtask'=>$subtask,
		));
        }

        public function getPassCriteria()
        {  
		$criterialist = CHtml::listData(PassCriteria::model()->findAllByAttributes(array('unit_id'=>Yii::app()->session['module_id'])),'id','criteria_no');
		return $criterialist;
	}

        public function getLearningOC()
        {  
		$criterialist = CHtml::listData(LearningOC::model()->findAllByAttributes(array('unitid'=>Yii::app()->session['module_id'])),'lerocid','title');
		return $criterialist;
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
				$this->redirect(array('view','id'=>$model->mngid));
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
		$dataProvider=new CActiveDataProvider('Assignment');
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
		$model=Assignment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
