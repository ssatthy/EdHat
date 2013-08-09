<?php

/**
 * This is the model class for table "tbl_course".
 *
 * The followings are the available columns in table 'tbl_course':
 * @property string $CourseIndex
 * @property string $CourseName
 * @property string $FacultyName
 * @property string $Catagory
 * @property string $Level
 * @property integer $SemiCount
 * @property double $CertificateFee
 * @property string $CourseType
 * @property string $EnterdBy
 *
 * The followings are the available model relations:
 * @property Center[] $centers
 * @property TblModule[] $tblModules
 * @property TblStudent[] $tblStudents
 */
class Course extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Course the static model class
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
		return 'tbl_course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CourseIndex, CourseName, FacultyName, Catagory, Level, SemiCount, CertificateFee, CourseType, EnterdBy', 'required'),
			array('SemiCount', 'numerical', 'integerOnly'=>true),
			array('CertificateFee', 'numerical'),
			array('CourseIndex', 'length', 'max'=>253),
			array('FacultyName, Catagory, CourseType, EnterdBy', 'length', 'max'=>50),
			array('Level', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CourseIndex, CourseName, FacultyName, Catagory, Level, SemiCount, CertificateFee, CourseType, EnterdBy', 'safe', 'on'=>'search'),
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
			'centers' => array(self::MANY_MANY, 'Center', 'center_course(CourseIndex, centerid)'),
			'tblModules' => array(self::MANY_MANY, 'TblModule', 'course_module(CourseIndex, SerialOrder)'),
			'tblStudents' => array(self::HAS_MANY, 'TblStudent', 'CourseNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CourseIndex' => 'Course Index',
			'CourseName' => 'Course Name',
			'FacultyName' => 'Faculty Name',
			'Catagory' => 'Catagory',
			'Level' => 'Level',
			'SemiCount' => 'Semi Count',
			'CertificateFee' => 'Certificate Fee',
			'CourseType' => 'Course Type',
			'EnterdBy' => 'Enterd By',
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

		$criteria->compare('CourseIndex',$this->CourseIndex,true);
		$criteria->compare('CourseName',$this->CourseName,true);
		$criteria->compare('FacultyName',$this->FacultyName,true);
		$criteria->compare('Catagory',$this->Catagory,true);
		$criteria->compare('Level',$this->Level,true);
		$criteria->compare('SemiCount',$this->SemiCount);
		$criteria->compare('CertificateFee',$this->CertificateFee);
		$criteria->compare('CourseType',$this->CourseType,true);
		$criteria->compare('EnterdBy',$this->EnterdBy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}