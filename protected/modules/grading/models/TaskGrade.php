<?php

/**
 * This is the model class for table "task_grade".
 *
 * The followings are the available columns in table 'task_grade':
 * @property integer $id
 * @property integer $cwork_id
 * @property integer $subtask_id
 * @property integer $marks
 * @property string $verifier_id
 * @property integer $verifier_type
 *
 * The followings are the available model relations:
 * @property CourseWork $cwork
 * @property Subtask $subtask
 * @property User $verifier
 */
class TaskGrade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TaskGrade the static model class
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
		return 'task_grade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cwork_id, subtask_id, marks, verifier_id, verifier_type', 'required'),
			array('cwork_id, subtask_id, marks, verifier_type', 'numerical', 'integerOnly'=>true),
			array('verifier_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cwork_id, subtask_id, marks, verifier_id, verifier_type', 'safe', 'on'=>'search'),
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
			'cwork' => array(self::BELONGS_TO, 'CourseWork', 'cwork_id'),
			'subtask' => array(self::BELONGS_TO, 'Subtask', 'subtask_id'),
			'verifier' => array(self::BELONGS_TO, 'User', 'verifier_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cwork_id' => 'Cwork',
			'subtask_id' => 'Subtask',
			'marks' => 'Marks',
			'verifier_id' => 'Verifier',
			'verifier_type' => 'Verifier Type',
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
		$criteria->compare('cwork_id',$this->cwork_id);
		$criteria->compare('subtask_id',$this->subtask_id);
		$criteria->compare('marks',$this->marks);
		$criteria->compare('verifier_id',$this->verifier_id,true);
		$criteria->compare('verifier_type',$this->verifier_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}