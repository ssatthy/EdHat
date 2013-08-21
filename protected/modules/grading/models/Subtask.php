<?php

/**
 * This is the model class for table "subtask".
 *
 * The followings are the available columns in table 'subtask':
 * @property integer $id
 * @property integer $task_id
 * @property string $sub_no
 * @property string $title
 * @property integer $pass_crit_item_id
 * @property integer $max_marks
 *
 * The followings are the available model relations:
 * @property PassCriteriaItem $passCritItem
 * @property Task $task
 * @property TaskGrade[] $taskGrades
 */
class Subtask extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subtask the static model class
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
		return 'subtask';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('task_id, sub_no, title, pass_crit_item_id, max_marks', 'required'),
			array('task_id, pass_crit_item_id, max_marks', 'numerical', 'integerOnly'=>true),
			array('sub_no', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, task_id, sub_no, title, pass_crit_item_id, max_marks', 'safe', 'on'=>'search'),
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
			'passCritItem' => array(self::BELONGS_TO, 'PassCriteriaItem', 'pass_crit_item_id'),
			'task' => array(self::BELONGS_TO, 'Task', 'task_id'),
			'taskGrades' => array(self::HAS_MANY, 'TaskGrade', 'subtask_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'task_id' => 'Task',
			'sub_no' => 'Subtask No',
			'title' => 'Title',
			'pass_crit_item_id' => 'Pass Crit Item',
			'max_marks' => 'Max Marks',
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
		$criteria->compare('task_id',$this->task_id);
		$criteria->compare('sub_no',$this->sub_no,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pass_crit_item_id',$this->pass_crit_item_id);
		$criteria->compare('max_marks',$this->max_marks);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}