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
				'actions'=>array('create','update','addpasscriteriaitem','addtask','addsubtask','DeleteCriteriaItem','DeleteTaskItem',
                                    'SubmitAssignment','GradePassCriteria','CourseWorkView','GradeMeritCriteria','GradeDistinctionCriteria','GradeTasks',
                                    'GradePassCriteriaUpdate','GradeMeritCriteriaUpdate','GradeDistinctionCriteriaUpdate','GradeTasksUpdate',
                                    'HandlePassCriteria','HandleMeritCriteria','HandleDistinctionCriteria','HandleTasks'),
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
            
            public function actionCourseWorkView($id)
            {
                 $coursework=  CourseWork::model()->findByPk($id);
                $assignment = Assignment::model()->findByPk($coursework->assign_id);
                   $courseworkstatus=    CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$coursework->id));
                if(sizeof($courseworkstatus)!=1)
                    $courseworkstatus=new CourseworkStatus ();
                   
                   $this->render('coursework_view',array(
			'assignment'=>$assignment,
                        'coursework'=>$coursework,
                        'courseworkstatus'=>$courseworkstatus,
                        
		));
                
            }
            
            public function actionHandlePassCriteria($id){
                
                 $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                 //if professor
               if(Yii::app()->user->checkAccess('1')){
                   
                   if($cworkStatus->prof_pass=='')
                       $this->actionGradePassCriteria ($id);
                   else
                       $this->actionGradePassCriteriaUpdate ($id,1);
                   
                   
               }
               //if internal supervisor
               if(Yii::app()->user->checkAccess('2')){
                   
                   if($cworkStatus->int_pass=='')
                       $this->actionGradePassCriteriaUpdate ($id,1);
                   else
                       $this->actionGradePassCriteriaUpdate ($id,2);
                }
                
                 if(Yii::app()->user->checkAccess('3')){
                   
                   if($cworkStatus->ext_pass==''){
                   if($cworkStatus->int_pass=='')
                       $this->actionGradePassCriteriaUpdate ($id,1);
                   else
                        $this->actionGradePassCriteriaUpdate ($id,2);
                   }
                   else
                       $this->actionGradePassCriteriaUpdate ($id,3);
                }
                
                 
                
            }

            public function actionGradePassCriteria($id)
            {
              
                if(isset($_POST['PcriteriaGrade']))
                    {
                   
                        $pass=true;
                        for($i=0;$i<sizeof($_POST['PcriteriaGrade']);$i++)
                        {
                            if(isset($_POST['PcriteriaGrade'][$i])){
                                $item = new PcriteriaGrade();
                                $item->attributes=$_POST['PcriteriaGrade'][$i];
                                $item->cwork_id=$id;
                              
                                if($item->grade=='NOK')
                                        $pass=false;
                                $item->save();
                       
                        }
                       }
                    $cworkStatus=new CourseworkStatus();
                    $cworkStatus->cwork_id=$id;
                    if($pass)
                        $cworkStatus->prof_pass='passed';
                            else
                              $cworkStatus->prof_pass='failed'; 
                            
                            $cworkStatus->save();
                       $this->redirect(array('CourseWorkView','id'=>$id));
                    }
                    
                   $passgrade = new PcriteriaGrade();  
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
                
                   
                        
                $this->render('/grade/grade_passcriteria',array(
			'model'=>$assignment,
                        'criteria'=>$passcriteria,
                        'criteriaitem'=>$criteria_items,
                        'passgrade'=>$passgrade,
                      
		));
            }
            
             public function actionGradePassCriteriaUpdate($id,$type)
            {
             
                if(isset($_POST['PcriteriaGrade']))
                    {
                   
                        $pass=true;
                        $itemid=array();
                        for($i=0;$i<sizeof($_POST['PcriteriaGrade']);$i++)
                        {
                            if(isset($_POST['PcriteriaGrade'][$i])){
                                $item = new PcriteriaGrade();
                               
                                $item->attributes=$_POST['PcriteriaGrade'][$i];
                                //if same type verifier, then update.but if new, then create
                                if($item->verifier_type==$type){
                                
                                $itemid=$_POST['PcriteriaGrade'][$i];
                                $item->id=$itemid['id'];
                                  $item->isNewRecord=false;
                                }
                                $item->cwork_id=$id;
                               
                                if($item->grade=='NOK')
                                        $pass=false;
                                $item->save();
                       
                        }
                     
                       }
                                     
                       $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                       
                    if($pass){
                    Yii::app()->user->role==1? $cworkStatus->prof_pass='passed' : (Yii::app()->user->role==2? $cworkStatus->int_pass='passed' : $cworkStatus->ext_pass='passed');}
                            else{
                    Yii::app()->user->role==1? $cworkStatus->prof_pass='failed' : (Yii::app()->user->role==2? $cworkStatus->int_pass='failed' : $cworkStatus->ext_pass='failed');}
                            
                            $cworkStatus->isNewRecord=false;
                            $cworkStatus->save();
                    
                       $this->redirect(array('CourseWorkView','id'=>$id));
                    }
                    
                   $passgrade = new PcriteriaGrade();  
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
                 $dataitems=array();
                $i=0;
                 for($x=0;$x<sizeof($passcriteria);$x++){
                     foreach ($criteria_items[$x]->getData() as $pitem){
                         $dataitems[$i]=  PcriteriaGrade::model()->findByAttributes(array('cwork_id'=>$id,'criteria_id'=>$pitem->id,'verifier_type'=>$type));
                     $i++;}
                 }
                   
                        
                $this->render('/grade/grade_passcriteria_update',array(
			'model'=>$assignment,
                        'criteria'=>$passcriteria,
                        'criteriaitem'=>$criteria_items,
                        'passgrade'=>$passgrade,
                        'dataitems'=>$dataitems,
                      
		));
            }

            
            public function actionHandleMeritCriteria($id){
                
                 $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                 //if professor
               if(Yii::app()->user->checkAccess('1')){
                   
                   if($cworkStatus->prof_merit==''){
                       if($cworkStatus->prof_pass=='passed')
                   $this->actionGradeMeritCriteria ($id);
                       else{
                           
                      throw new CHttpException('Previous Criteria is not met :(');
                       
                       }
                   }
                   else
                       $this->actionGradeMeritCriteriaUpdate ($id,1);
                   
                   
               }
               //if internal supervisor
               if(Yii::app()->user->checkAccess('2')){
                   
                   if($cworkStatus->int_merit==''){
                       if($cworkStatus->int_pass=='passed')
                       $this->actionGradeMeritCriteriaUpdate ($id,1);
                       else
                             throw new CHttpException('Previous Criteria is not met :(');
                   }
                   else
                       $this->actionGradeMeritCriteriaUpdate ($id,2);
                }
                
                 if(Yii::app()->user->checkAccess('3')){
                   
                   if($cworkStatus->ext_merit==''){
                   if($cworkStatus->int_merit==''){
                        if($cworkStatus->ext_pass=='passed')
                   $this->actionGradeMeritCriteriaUpdate ($id,1);
                   else
                     throw new CHttpException('Previous Criteria is not met :('); 
                   }
                   else{
                        if($cworkStatus->ext_pass=='passed')
                        $this->actionGradeMeritCriteriaUpdate ($id,2);
                        else
                             throw new CHttpException('Previous Criteria is not met :('); 
                   }
                   }
                   else
                       $this->actionGradeMeritCriteriaUpdate ($id,3);
                }
                
                
                
                
            }
            
          public function actionGradeMeritCriteria($id){
              
                if(isset($_POST['McriteriaGrade']))
                    {
                   
                        $pass=true;
                        for($i=0;$i<sizeof($_POST['McriteriaGrade']);$i++)
                        {
                            if(isset($_POST['McriteriaGrade'][$i])){
                                $item = new McriteriaGrade();
                                $item->attributes=$_POST['McriteriaGrade'][$i];
                                $item->cwork_id=$id;
                                if($item->grade=='NOK')
                                    $pass=false;
                                $item->save();
                       
                        }
                       }
                      $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                    
                    if($pass)
                        $cworkStatus->prof_merit='passed';
                            else
                              $cworkStatus->prof_merit='failed'; 
                            
                            $cworkStatus->isNewRecord=false;
                            
                            $cworkStatus->save();
                       $this->redirect(array('CourseWorkView','id'=>$id));
                    }
                    
                   $meritgrade = new McriteriaGrade();  
                 $coursework=  CourseWork::model()->findByPk($id);
                $assignment = Assignment::model()->findByPk($coursework->assign_id);
               
               $meritCriteria = MeritCriteria::model()->findAllByAttributes(array('unit_id'=>$assignment->unitid));
                
                $criteria_items= array();
                for($x=0;$x<sizeof($meritCriteria);$x++){
                    $criteria=new CDbCriteria;
                $criteria->addCondition('meritc_id=:value');
               
               $criteria->params=array(':value'=>$meritCriteria[$x]->id);
                $criteria_items[$x] = new CActiveDataProvider("MeritCriteriaItem",array('criteria'=>$criteria));
                }
                
                   
                        
                $this->render('/grade/grade_meritcriteria',array(
			'model'=>$assignment,
                        'criteria'=>$meritCriteria,
                        'criteriaitem'=>$criteria_items,
                        'meritgrade'=>$meritgrade,
                      
		));
              
          }
          
          public function actionGradeMeritCriteriaUpdate($id,$type)
            {
             
                if(isset($_POST['McriteriaGrade']))
                    {
                   
                        $pass=true;
                         $itemid=array();
                        for($i=0;$i<sizeof($_POST['McriteriaGrade']);$i++)
                        {
                            if(isset($_POST['McriteriaGrade'][$i])){
                                $item = new McriteriaGrade();
                                
                                $item->attributes=$_POST['McriteriaGrade'][$i];
                                if($item->verifier_type==$type){
                               
                                $itemid=$_POST['McriteriaGrade'][$i];
                                $item->id=$itemid['id'];
                                 $item->isNewRecord=false;
                                }
                                $item->cwork_id=$id;
                               
                                if($item->grade=='NOK')
                                        $pass=false;
                                $item->save();
                       
                        }
                     
                       }
                                     
                       $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                    if($pass){
                    Yii::app()->user->role==1? $cworkStatus->prof_merit='passed' : (Yii::app()->user->role==2? $cworkStatus->int_merit='passed' : $cworkStatus->ext_merit='passed');}
                            else{
                    Yii::app()->user->role==1? $cworkStatus->prof_merit='failed' : (Yii::app()->user->role==2? $cworkStatus->int_merit='failed' : $cworkStatus->ext_merit='failed');}
                      
                            $cworkStatus->isNewRecord=false;
                            $cworkStatus->save();
                    
                       $this->redirect(array('CourseWorkView','id'=>$id));
                    }
                    
                   $meritgrade = new McriteriaGrade();  
                 $coursework=  CourseWork::model()->findByPk($id);
                $assignment = Assignment::model()->findByPk($coursework->assign_id);
               
               $meritCriteria = MeritCriteria::model()->findAllByAttributes(array('unit_id'=>$assignment->unitid));
                
                $criteria_items= array();
                for($x=0;$x<sizeof($meritCriteria);$x++){
                    $criteria=new CDbCriteria;
                $criteria->addCondition('meritc_id=:value');
               
               $criteria->params=array(':value'=>$meritCriteria[$x]->id);
                $criteria_items[$x] = new CActiveDataProvider("MeritCriteriaItem",array('criteria'=>$criteria));
                }
                 $dataitems=array();
                $i=0;
                 for($x=0;$x<sizeof($meritCriteria);$x++){
                     foreach ($criteria_items[$x]->getData() as $pitem){
                         $dataitems[$i]=  McriteriaGrade::model()->findByAttributes(array('cwork_id'=>$id,'criteria_id'=>$pitem->id,'verifier_type'=>$type));
                     $i++;}
                 }
                   
                        
                $this->render('/grade/grade_meritcriteria_update',array(
			'model'=>$assignment,
                        'criteria'=>$meritCriteria,
                        'criteriaitem'=>$criteria_items,
                        'meritgrade'=>$meritgrade,
                        'dataitems'=>$dataitems,
                      
		));
            }
          
            
          public function actionHandleDistinctionCriteria($id){
                
                 $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                 //if professor
               if(Yii::app()->user->checkAccess('1')){
                   
                   if($cworkStatus->prof_distn==''){
                       if($cworkStatus->prof_merit=='passed')
                   $this->actionGradeDistinctionCriteria ($id);
                       
                       else
                            throw new CHttpException('Previous Criteria is not met :(');
                   }
                   else
                       $this->actionGradeDistinctionCriteriaUpdate($id,1);
                   
                   
               }
               //if internal supervisor
               if(Yii::app()->user->checkAccess('2')){
                   
                   if($cworkStatus->int_distn==''){
                       if($cworkStatus->int_merit=='passed')
                   $this->actionGradeDistinctionCriteriaUpdate ($id,1);
                       else
                          throw new CHttpException('Previous Criteria is not met :(');
                   }
                   else
                       $this->actionGradeDistinctionCriteriaUpdate ($id,2);
                }
                
                 if(Yii::app()->user->checkAccess('3')){
                   
                   if($cworkStatus->ext_distn==''){
                   if($cworkStatus->int_distn==''){
                       if($cworkStatus->ext_merit=='passed')
                   $this->actionGradeDistinctionCriteriaUpdate ($id,1);
                       else
                           throw new CHttpException('Previous Criteria is not met :(');
                   
                   }
                   else{
                      if($cworkStatus->ext_merit=='passed') 
                   $this->actionGradeDistinctionCriteriaUpdate ($id,2);
                   else
                           throw new CHttpException('Previous Criteria is not met :('); 
                   }
                   }
                   else
                       $this->actionGradeDistinctionCriteriaUpdate ($id,3);
                }
                
                 
            }
            
            
          public function actionGradeDistinctionCriteria($id){
              
                if(isset($_POST['DcriteriaGrade']))
                    {
                   
                        $pass=true;
                        for($i=0;$i<sizeof($_POST['DcriteriaGrade']);$i++)
                        {
                            if(isset($_POST['DcriteriaGrade'][$i])){
                                $item = new DcriteriaGrade();
                                $item->attributes=$_POST['DcriteriaGrade'][$i];
                                $item->cwork_id=$id;
                                if($item->grade=='NOK')
                                        $pass=false;
                                $item->save();
                       
                        }
                       }
                      $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                    
                    if($pass)
                        $cworkStatus->prof_distn='passed';
                            else
                              $cworkStatus->prof_distn='failed'; 
                            
                            $cworkStatus->isNewRecord=false;
                            $cworkStatus->save();
                            
                       $this->redirect(array('CourseWorkView','id'=>$id));
                    }
                    
                   $distngrade = new DcriteriaGrade();  
                 $coursework=  CourseWork::model()->findByPk($id);
                $assignment = Assignment::model()->findByPk($coursework->assign_id);
               
               $distnCriteria = DistinctionCriteria::model()->findAllByAttributes(array('unit_id'=>$assignment->unitid));
                
                $criteria_items= array();
                for($x=0;$x<sizeof($distnCriteria);$x++){
                    $criteria=new CDbCriteria;
                $criteria->addCondition('distn_id=:value');
               
               $criteria->params=array(':value'=>$distnCriteria[$x]->id);
                $criteria_items[$x] = new CActiveDataProvider("DistCriteriaItem",array('criteria'=>$criteria));
                }
                
                   
                        
                $this->render('/grade/grade_distncriteria',array(
			'model'=>$assignment,
                        'criteria'=>$distnCriteria,
                        'criteriaitem'=>$criteria_items,
                        'distngrade'=>$distngrade,
                      
		));
              
          }
          
          
          public function actionGradeDistinctionCriteriaUpdate($id,$type)
            {
             
                if(isset($_POST['DcriteriaGrade']))
                    {
                   
                        $pass=true;
                        $itemid=array();
                        for($i=0;$i<sizeof($_POST['DcriteriaGrade']);$i++)
                        {
                            if(isset($_POST['DcriteriaGrade'][$i])){
                                $item = new DcriteriaGrade();
                                
                                $item->attributes=$_POST['DcriteriaGrade'][$i];
                                if($item->verifier_type==$type){
                                $itemid=$_POST['DcriteriaGrade'][$i];
                                $item->id=$itemid['id'];
                                 $item->isNewRecord=false;
                                }
                                $item->cwork_id=$id;
                               
                                if($item->grade=='NOK')
                                        $pass=false;
                                $item->save();
                       
                        }
                     
                       }
                                     
                       $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                  if($pass){
                    Yii::app()->user->role==1? $cworkStatus->prof_distn='passed' : (Yii::app()->user->role==2? $cworkStatus->int_distn='passed' : $cworkStatus->ext_distn='passed');}
                            else{
                    Yii::app()->user->role==1? $cworkStatus->prof_distn='failed' : (Yii::app()->user->role==2? $cworkStatus->int_distn='failed' : $cworkStatus->ext_distn='failed');}
                    
                            $cworkStatus->isNewRecord=false;
                            $cworkStatus->save();
                    
                       $this->redirect(array('CourseWorkView','id'=>$id));
                    }
                    
                   $distngrade = new DcriteriaGrade();  
                 $coursework=  CourseWork::model()->findByPk($id);
                $assignment = Assignment::model()->findByPk($coursework->assign_id);
               
               $distnCriteria = DistinctionCriteria::model()->findAllByAttributes(array('unit_id'=>$assignment->unitid));
                
                $criteria_items= array();
                for($x=0;$x<sizeof($distnCriteria);$x++){
                    $criteria=new CDbCriteria;
                $criteria->addCondition('distn_id=:value');
               
               $criteria->params=array(':value'=>$distnCriteria[$x]->id);
                $criteria_items[$x] = new CActiveDataProvider("DistCriteriaItem",array('criteria'=>$criteria));
                }
                 $dataitems=array();
                $i=0;
                 for($x=0;$x<sizeof($distnCriteria);$x++){
                     foreach ($criteria_items[$x]->getData() as $pitem){
                         $dataitems[$i]= DcriteriaGrade::model()->findByAttributes(array('cwork_id'=>$id,'criteria_id'=>$pitem->id,'verifier_type'=>$type));
                     $i++;}
                 }
                   
                        
                $this->render('/grade/grade_distncriteria_update',array(
			'model'=>$assignment,
                        'criteria'=>$distnCriteria,
                        'criteriaitem'=>$criteria_items,
                        'distngrade'=>$distngrade,
                        'dataitems'=>$dataitems,
                      
		));
            }
            
            public function actionHandleTasks($id){
                
                 $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                 //if professor
               if(Yii::app()->user->checkAccess('1')){
                   
                   if($cworkStatus->prof_task=='')
                       $this->actionGradeTasks ($id);
                   else
                       $this->actionGradeTasksUpdate ($id,1);
                   
                   
               }
               //if internal supervisor
               if(Yii::app()->user->checkAccess('2')){
                   
                   if($cworkStatus->int_task=='')
                       $this->actionGradeTasksUpdate ($id,1);
                   else
                       $this->actionGradeTasksUpdate ($id,2);
                }
                
                 if(Yii::app()->user->checkAccess('3')){
                   
                   if($cworkStatus->ext_task==''){
                   if($cworkStatus->int_task=='')
                       $this->actionGradeTasksUpdate ($id,1);
                   else
                        $this->actionGradeTasksUpdate ($id,2);
                   }
                   else
                       $this->actionGradeTasksUpdate ($id,3);
                }
                
                 
                
            }
            
            
          public function actionGradeTasks($id){
              
                if(isset($_POST['TaskGrade']))
                    {
                   
                        $taskok=true;
                        for($i=0;$i<sizeof($_POST['TaskGrade']);$i++)
                        {
                            if(isset($_POST['TaskGrade'][$i])){
                                $item = new TaskGrade();
                                $item->attributes=$_POST['TaskGrade'][$i];
                                $item->cwork_id=$id;
                                $subtaskitem=$item->subtask;
                                if($item->marks > $subtaskitem->max_marks)
                                    $taskok=false;
                                $item->save();
                       
                        }
                       }
                       $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                       $cworkStatus->isNewRecord=false;
                       
                   $passok = $this->isMarksEnough($id);
                    
                    if(!$taskok && !$passok){
                      $cworkStatus->prof_task='NOK';
                      Yii::app()->user->setFlash('error','The given marks can not be greater than max marks </br> And The overall marks does not meet the passed criteria </br> Please Edit your grades for tasks!');
                      
                    }
                    elseif(!$taskok){
                    $cworkStatus->prof_task='TNOK';
                     Yii::app()->user->setFlash('error','The given marks can not be greater than max marks </br> Please Edit your grades for tasks!');
                    
                    }
                    elseif(!$passok){
                        $cworkStatus->prof_task='PNOK';
                        Yii::app()->user->setFlash('error','Overall marks does not meet the passed criteria </br> Please Edit your grades for tasks!');
                    }
                            else
                              $cworkStatus->prof_task='OK'; 
                            
                            
                            $cworkStatus->save();
                    
                       $this->redirect(array('CourseWorkView','id'=>$id));
                    }
                    
                   $taskgrade = new TaskGrade();  
                 $coursework=  CourseWork::model()->findByPk($id);
                $assignment = Assignment::model()->findByPk($coursework->assign_id);
               
               $tasks = Task::model()->findAllByAttributes(array('assign_id'=>$assignment->mngid));
                
                $subtasks= array();
                for($x=0;$x<sizeof($tasks);$x++){
                    $criteria=new CDbCriteria;
                $criteria->addCondition('task_id=:value');
               
               $criteria->params=array(':value'=>$tasks[$x]->id);
                $subtasks[$x] = new CActiveDataProvider("Subtask",array('criteria'=>$criteria));
                }
                
                  $this->render('/grade/grade_subtasks',array(
			'model'=>$assignment,
                        'tasks'=>$tasks,
                        'subtasks'=>$subtasks,
                        'taskgrade'=>$taskgrade,
                      
		));
              
          }
          
           public function isMarksEnough($id){
               $rows = Yii::app()->db->createCommand()
                ->select('t.lo_id as id,sum(marks) as msum')
                ->from('task_grade')
                ->where(array('AND','task_grade.cwork_id=:cid','task_grade.verifier_type=:type'),array(':cid'=>$id,':type'=>Yii::app()->user->role))
                ->join('subtask s','task_grade.subtask_id = s.id')
                ->join('task t', 't.id = s.task_id')
                
                ->group('t.id')               
                ->queryAll(); 
               
               $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
               $overall=0;
        foreach ($rows as $i)
        {
            $pers = Yii::app()->db->createCommand()
                ->select('qpersentage')
                ->from('learningoc')
                ->where('lerocid='.$i['id'])
                ->queryRow();
            $overall +=$i['msum']*$pers['qpersentage']/100;
            
        }
      //  print_r ($i['id']);echo '---'; print_r ($i['msum']); echo '---%'; print_r($pers['qpersentage']); echo '</br>';}
      //print_r($overall) ; die();
        $returnval=false;
        // for professor
        if(Yii::app()->user->role==1){
        if($cworkStatus->prof_pass=='failed'){
        if($overall>=0 && $overall<=35)
        $returnval=true;}
        
        elseif($cworkStatus->prof_merit=='failed'){
        if($overall>=36 && $overall<=64)
        $returnval=true;  }
        
       else if($cworkStatus->prof_distn=='failed'){
        if($overall>=65 && $overall<=74)
       $returnval=true;  }
       else if($cworkStatus->prof_distn=='passed'){
        if($overall>=75 && $overall<=100)
       $returnval=true;  }
        
        }
        if(Yii::app()->user->role==2){
        if($cworkStatus->int_pass=='failed'){
        if($overall>=0 && $overall<=35)
        $returnval=true;}
        
        elseif($cworkStatus->int_merit=='failed'){
        if($overall>=36 && $overall<=64)
        $returnval=true;  }
        
       else if($cworkStatus->int_distn=='failed'){
        if($overall>=65 && $overall<=74)
       $returnval=true;  }
       else if($cworkStatus->int_distn=='passed'){
        if($overall>=75 && $overall<=100)
       $returnval=true;  }
        
        }
        if(Yii::app()->user->role==3){
        if($cworkStatus->ext_pass=='failed'){
        if($overall>=0 && $overall<=35)
        $returnval=true;}
        
        elseif($cworkStatus->ext_merit=='failed'){
        if($overall>=36 && $overall<=64)
        $returnval=true;  }
        
       else if($cworkStatus->ext_distn=='failed'){
        if($overall>=65 && $overall<=74)
       $returnval=true;  }
       else if($cworkStatus->ext_distn=='passed'){
        if($overall>=75 && $overall<=100)
       $returnval=true;  }
        
        }
        
        return $returnval;;
        
      }
            
          public function actionGradeTasksUpdate($id,$type)
            {
             
                if(isset($_POST['TaskGrade']))
                    {
                   
                        $taskok=true;
                        $itemid=array();
                        for($i=0;$i<sizeof($_POST['TaskGrade']);$i++)
                        {
                            if(isset($_POST['TaskGrade'][$i])){
                                $item = new TaskGrade();
                               
                                $item->attributes=$_POST['TaskGrade'][$i];
                               
                                if($item->verifier_type==$type){
                                $itemid=$_POST['TaskGrade'][$i];
                                $item->id=$itemid['id'];
                                $item->isNewRecord=false;
                                }
                                $item->cwork_id=$id;
                               $subtaskitem=$item->subtask;
                                if($item->marks > $subtaskitem->max_marks)
                                    $taskok=false;
                                
                                $item->save();
                       
                        }
                     
                       }
                                     
                       $cworkStatus=  CourseworkStatus::model()->findByAttributes(array('cwork_id'=>$id));
                
                      $passok = $this->isMarksEnough($id); 
        
        
                    if(!$passok && !$taskok){
                        Yii::app()->user->role==1? $cworkStatus->prof_task='NOK' : (Yii::app()->user->role==2? $cworkStatus->int_task='NOK' : $cworkStatus->ext_task='NOK');
                         Yii::app()->user->setFlash('error','The given marks can not be greater than max marks </br> And The overall marks does not meet the passed criteria </br> Please Edit your grades for tasks!');
                    
                        
                    }
                    elseif(!$passok){
                    Yii::app()->user->role==1? $cworkStatus->prof_task='PNOK' : (Yii::app()->user->role==2? $cworkStatus->int_task='PNOK' : $cworkStatus->ext_task='PNOK');
                    
                    
                      Yii::app()->user->setFlash('error','The overall marks does not meet the passed criteria </br> Please Edit your grades for tasks!');
                    }
                    elseif(!$taskok){
                    Yii::app()->user->role==1? $cworkStatus->prof_task='TNOK' : (Yii::app()->user->role==2? $cworkStatus->int_task='TNOK' : $cworkStatus->ext_task='TNOK');
                     Yii::app()->user->setFlash('error','The given marks can not be greater than max marks </br> Please Edit your grades for tasks!');
                   
                    
                    }
                    else{
                    Yii::app()->user->role==1? $cworkStatus->prof_task='OK' : (Yii::app()->user->role==2? $cworkStatus->int_task='OK' : $cworkStatus->ext_task='OK');
                    
                    
                    }
                    
                            $cworkStatus->isNewRecord=false;
                            $cworkStatus->save();
                    
                       $this->redirect(array('CourseWorkView','id'=>$id));
                    }
                    
                   $taskgrade = new TaskGrade();  
                 $coursework=  CourseWork::model()->findByPk($id);
                $assignment = Assignment::model()->findByPk($coursework->assign_id);
               
               $tasks = Task::model()->findAllByAttributes(array('assign_id'=>$assignment->mngid));
                
                $subtasks= array();
                for($x=0;$x<sizeof($tasks);$x++){
                    $criteria=new CDbCriteria;
                $criteria->addCondition('task_id=:value');
               
               $criteria->params=array(':value'=>$tasks[$x]->id);
                $subtasks[$x] = new CActiveDataProvider("Subtask",array('criteria'=>$criteria));
                }
                 $dataitems=array();
                $i=0;
                 for($x=0;$x<sizeof($tasks);$x++){
                     foreach ($subtasks[$x]->getData() as $pitem){
                         $dataitems[$i]= TaskGrade::model()->findByAttributes(array('cwork_id'=>$id,'subtask_id'=>$pitem->id,'verifier_type'=>$type));
                     $i++;}
                 }
                   
                        
                $this->render('/grade/grade_subtasks_update',array(
			'model'=>$assignment,
                        'tasks'=>$tasks,
                        'subtasks'=>$subtasks,
                        'taskgrade'=>$taskgrade,
                        'dataitems'=>$dataitems,
                      
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
        
        public function actionDeleteCriteriaItem($id)
                {
            $item=  PassCriteriaItem::model()->findByPk($id);
           $item->delete();
        }
        public function actionDeleteTaskItem($id)
                {
            $item= Subtask::model()->findByPk($id);
           $item->delete();
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
