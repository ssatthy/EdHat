<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property integer $lo_id
 * @property integer $assign_id
 * @property string $task_no
 *
 * The followings are the available model relations:
 * @property Subtask[] $subtasks
 * @property Asgmng $assign
 * @property Learningoc $lo
 */
class Task extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Task the static model class
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
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lo_id, assign_id, task_no', 'required'),
			array('lo_id, assign_id', 'numerical', 'integerOnly'=>true),
			array('task_no', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, lo_id, assign_id, task_no', 'safe', 'on'=>'search'),
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
			'subtasks' => array(self::HAS_MANY, 'Subtask', 'task_id'),
			'assign' => array(self::BELONGS_TO, 'Asgmng', 'assign_id'),
			'lo' => array(self::BELONGS_TO, 'Learningoc', 'lo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lo_id' => 'Lo',
			'assign_id' => 'Assign',
			'task_no' => 'Task No',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('lo_id',$this->lo_id);
		$criteria->compare('assign_id',$this->assign_id);
		$criteria->compare('task_no',$this->task_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}