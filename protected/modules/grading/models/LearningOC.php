<?php

/**
 * This is the model class for table "learningoc".
 *
 * The followings are the available columns in table 'learningoc':
 * @property integer $lerocid
 * @property integer $unitid
 * @property string $title
 * @property string $discription
 * @property integer $qpersentage
 * @property string $status
 *
 * The followings are the available model relations:
 * @property TblModule $unit
 * @property Task[] $tasks
 */
class LearningOC extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LearningOC the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'learningoc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unitid, title, discription, qpersentage, status', 'required'),
			array('unitid, qpersentage', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>660),
			array('status', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lerocid, unitid, title, discription, qpersentage, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'unit' => array(self::BELONGS_TO, 'TblModule', 'unitid'),
			'tasks' => array(self::HAS_MANY, 'Task', 'lo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lerocid' => 'Lerocid',
			'unitid' => 'Unitid',
			'title' => 'Title',
			'discription' => 'Discription',
			'qpersentage' => 'Qpersentage',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                $criteria->condition='unitid=:value';
                $criteria->params=array(':value'=>Yii::app()->session['module_id']);
                
		$criteria->compare('lerocid',$this->lerocid);
		$criteria->compare('unitid',$this->unitid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('discription',$this->discription,true);
		$criteria->compare('qpersentage',$this->qpersentage);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}