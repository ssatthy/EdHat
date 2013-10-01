<?php

/**
 * This is the model class for table "course_work".
 *
 * The followings are the available columns in table 'course_work':
 * @property integer $id
 * @property integer $assign_id
 * @property string $student_id
 * @property string $source_file_path
 *
 * The followings are the available model relations:
 * @property Asgmng $assign
 * @property TblStudent $student
 * @property DcriteriaGrade[] $dcriteriaGrades
 * @property McriteriaGrade[] $mcriteriaGrades
 * @property PcriteriaGrade[] $pcriteriaGrades
 * @property TaskGrade[] $taskGrades
 */
class CourseWork extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CourseWork the static model class
	 */
    public $source_file;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'course_work';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('assign_id, student_id, source_file_path', 'required'),
			array('assign_id', 'numerical', 'integerOnly'=>true),
			array('student_id', 'length', 'max'=>45),
                        array('source_file', 'file', 'types'=>'doc,zip,docx,pdf'),
			array('source_file_path', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, assign_id, student_id, source_file_path', 'safe', 'on'=>'search'),
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
			'assign' => array(self::BELONGS_TO, 'Asgmng', 'assign_id'),
			'student' => array(self::BELONGS_TO, 'TblStudent', 'student_id'),
			'dcriteriaGrades' => array(self::HAS_MANY, 'DcriteriaGrade', 'cwork_id'),
			'mcriteriaGrades' => array(self::HAS_MANY, 'McriteriaGrade', 'cwork_id'),
			'pcriteriaGrades' => array(self::HAS_MANY, 'PcriteriaGrade', 'cwork_id'),
			'taskGrades' => array(self::HAS_MANY, 'TaskGrade', 'cwork_id'),
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
			'source_file_path' => 'Source File Path',
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
		$criteria->compare('source_file_path',$this->source_file_path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}