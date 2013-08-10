<?php

/**
 * This is the model class for table "tbl_student".
 *
 * The followings are the available columns in table 'tbl_student':
 * @property string $EdHatNo
 * @property string $CourseNo
 * @property string $InstituteID
 * @property string $StudentFullName
 * @property string $Gender
 * @property string $DateofReg
 * @property string $PaymentID
 * @property string $DateofBirth
 * @property string $Country
 * @property string $ProofIDNo
 * @property string $InvoiceNo
 * @property string $OtherEdHatNo
 * @property string $contactMail
 * @property string $IDProof
 * @property string $BranchNo
 *
 * The followings are the available model relations:
 * @property Grade[] $grades
 * @property StudentLogin $studentLogin
 * @property TblCourse $courseNo
 * @property TblStuupghistory[] $tblStuupghistories
 */
class Student extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Student the static model class
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
		return 'tbl_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EdHatNo, CourseNo, InstituteID, StudentFullName, Gender, DateofReg, PaymentID, DateofBirth, Country, ProofIDNo, InvoiceNo, OtherEdHatNo, contactMail, IDProof, BranchNo', 'required'),
			array('EdHatNo', 'length', 'max'=>255),
			array('CourseNo, InstituteID, PaymentID, Country, ProofIDNo, InvoiceNo, OtherEdHatNo, IDProof, BranchNo', 'length', 'max'=>50),
			array('StudentFullName, contactMail', 'length', 'max'=>500),
			array('Gender', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EdHatNo, CourseNo, InstituteID, StudentFullName, Gender, DateofReg, PaymentID, DateofBirth, Country, ProofIDNo, InvoiceNo, OtherEdHatNo, contactMail, IDProof, BranchNo', 'safe', 'on'=>'search'),
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
			'grades' => array(self::HAS_MANY, 'Grade', 'student_id'),
			'studentLogin' => array(self::HAS_ONE, 'StudentLogin', 'userid'),
			'courseNo' => array(self::BELONGS_TO, 'TblCourse', 'CourseNo'),
			'tblStuupghistories' => array(self::HAS_MANY, 'TblStuupghistory', 'EdHatNo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'EdHatNo' => 'Ed Hat No',
			'CourseNo' => 'Course No',
			'InstituteID' => 'Institute',
			'StudentFullName' => 'Student Full Name',
			'Gender' => 'Gender',
			'DateofReg' => 'Dateof Reg',
			'PaymentID' => 'Payment',
			'DateofBirth' => 'Dateof Birth',
			'Country' => 'Country',
			'ProofIDNo' => 'Proof Idno',
			'InvoiceNo' => 'Invoice No',
			'OtherEdHatNo' => 'Other Ed Hat No',
			'contactMail' => 'Contact Mail',
			'IDProof' => 'Idproof',
			'BranchNo' => 'Branch No',
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

		$criteria->compare('EdHatNo',$this->EdHatNo,true);
		$criteria->compare('CourseNo',$this->CourseNo,true);
		$criteria->compare('InstituteID',$this->InstituteID,true);
		$criteria->compare('StudentFullName',$this->StudentFullName,true);
		$criteria->compare('Gender',$this->Gender,true);
		$criteria->compare('DateofReg',$this->DateofReg,true);
		$criteria->compare('PaymentID',$this->PaymentID,true);
		$criteria->compare('DateofBirth',$this->DateofBirth,true);
		$criteria->compare('Country',$this->Country,true);
		$criteria->compare('ProofIDNo',$this->ProofIDNo,true);
		$criteria->compare('InvoiceNo',$this->InvoiceNo,true);
		$criteria->compare('OtherEdHatNo',$this->OtherEdHatNo,true);
		$criteria->compare('contactMail',$this->contactMail,true);
		$criteria->compare('IDProof',$this->IDProof,true);
		$criteria->compare('BranchNo',$this->BranchNo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}