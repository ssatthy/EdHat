<?php

/**
 * This is the model class for table "asgmng".
 *
 * The followings are the available columns in table 'asgmng':
 * @property integer $mngid
 * @property integer $unitid
 * @property integer $assign_no
 * @property string $title
 * @property string $status
 *
 * The followings are the available model relations:
 * @property TblModule $unit
 * @property CourseWork[] $courseWorks
 * @property PassCriteriaItem[] $passCriteriaItems
 * @property Task[] $tasks
 */
class Assignment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Assignment the static model class
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
		return 'asgmng';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unitid, assign_no, title, status', 'required'),
			array('unitid, assign_no', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mngid, unitid, assign_no, title, status', 'safe', 'on'=>'search'),
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
			'courseWorks' => array(self::HAS_MANY, 'CourseWork', 'assign_id'),
			'passCriteriaItems' => array(self::HAS_MANY, 'PassCriteriaItem', 'assign_id'),
			'tasks' => array(self::HAS_MANY, 'Task', 'assign_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mngid' => 'Mngid',
			'unitid' => 'Unitid',
			'assign_no' => 'No',
			'title' => 'Title',
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

		$criteria->compare('mngid',$this->mngid);
		$criteria->compare('unitid',$this->unitid);
		$criteria->compare('assign_no',$this->assign_no);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}