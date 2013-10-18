<?php

/**
 * This is the model class for table "coursework_status".
 *
 * The followings are the available columns in table 'coursework_status':
 * @property integer $id
 * @property string $prof_pass
 * @property string $prof_merit
 * @property string $prof_distn
 * @property string $prof_task
 * @property string $prof_approved
 */
class CourseworkStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CourseworkStatus the static model class
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
		return 'coursework_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prof_pass, prof_merit, prof_distn, prof_task, prof_approved', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, prof_pass, prof_merit, prof_distn, prof_task, prof_approved', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'prof_pass' => 'Prof Pass',
			'prof_merit' => 'Prof Merit',
			'prof_distn' => 'Prof Distn',
			'prof_task' => 'Prof Task',
			'prof_approved' => 'Prof Approved',
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
		$criteria->compare('prof_pass',$this->prof_pass,true);
		$criteria->compare('prof_merit',$this->prof_merit,true);
		$criteria->compare('prof_distn',$this->prof_distn,true);
		$criteria->compare('prof_task',$this->prof_task,true);
		$criteria->compare('prof_approved',$this->prof_approved,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}