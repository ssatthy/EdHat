<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		if (Yii::app()->user->checkAccess('3'))
		$this->redirect(array('country/admin'));
		if (Yii::app()->user->checkAccess('2'))
		$this->redirect(array('center/admin'));
		if (Yii::app()->user->checkAccess('1'))
		$this->redirect(array('module/admin'));
		if (Yii::app()->user->checkAccess('0'))
		$this->redirect(array('module/student'));
	}
}