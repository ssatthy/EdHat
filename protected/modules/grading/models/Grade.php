<?php

/**
 * This is the model class for table "grade".
 *
 * The followings are the available columns in table 'grade':
 * @property integer $id
 * @property integer $assign_id
 * @property string $student_id
 * @property string $verifier_id
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Assignment $assign
 * @property TblStudent $student
 * @property User $verifier
 * @property Gradecolumn $gradecolumn
 */
class Grade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Grade the static model class
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
		return 'grade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('assign_id, student_id, verifier_id', 'required'),
			array('assign_id', 'numerical', 'integerOnly'=>true),
			array('student_id, verifier_id', 'length', 'max'=>255),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, assign_id, student_id, verifier_id, comment', 'safe', 'on'=>'search'),
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
			'assign' => array(self::BELONGS_TO, 'Assignment', 'assign_id'),
			'student' => array(self::BELONGS_TO, 'TblStudent', 'student_id'),
			'verifier' => array(self::BELONGS_TO, 'User', 'verifier_id'),
			'gradecolumn' => array(self::HAS_ONE, 'Gradecolumn', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'assign_id' => 'Assign',
			'student_id' => 'Student',
			'verifier_id' => 'Verifier',
			'comment' => 'Comment',
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
		$criteria->compare('assign_id',$this->assign_id);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('verifier_id',$this->verifier_id,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}