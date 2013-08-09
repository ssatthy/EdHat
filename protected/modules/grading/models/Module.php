<?php

/**
 * This is the model class for table "tbl_module".
 *
 * The followings are the available columns in table 'tbl_module':
 * @property integer $SerialOrder
 * @property string $ModuleIndex
 * @property string $ModuleName
 * @property string $CourseNo
 * @property integer $Semister
 * @property string $Catagery
 * @property integer $Cradit
 * @property string $Assement
 *
 * The followings are the available model relations:
 * @property Assignement[] $assignements
 * @property TblCourse[] $tblCourses
 * @property User[] $users
 */
class Module extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Module the static model class
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
		return 'tbl_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ModuleIndex, ModuleName, CourseNo, Semister, Catagery, Cradit, Assement', 'required'),
			array('Semister, Cradit', 'numerical', 'integerOnly'=>true),
			array('ModuleIndex, CourseNo, Assement', 'length', 'max'=>50),
			array('Catagery', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SerialOrder, ModuleIndex, ModuleName, CourseNo, Semister, Catagery, Cradit, Assement', 'safe', 'on'=>'search'),
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
			'assignements' => array(self::HAS_MANY, 'Assignement', 'serial_order'),
			'tblCourses' => array(self::MANY_MANY, 'TblCourse', 'course_module(SerialOrder, CourseIndex)'),
			'users' => array(self::MANY_MANY, 'User', 'professor(module_id, professor)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SerialOrder' => 'Serial Order',
			'ModuleIndex' => 'Module Index',
			'ModuleName' => 'Module Name',
			'CourseNo' => 'Course No',
			'Semister' => 'Semister',
			'Catagery' => 'Catagery',
			'Cradit' => 'Cradit',
			'Assement' => 'Assement',
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

		$criteria->compare('SerialOrder',$this->SerialOrder);
		$criteria->compare('ModuleIndex',$this->ModuleIndex,true);
		$criteria->compare('ModuleName',$this->ModuleName,true);
		$criteria->compare('CourseNo',$this->CourseNo,true);
		$criteria->compare('Semister',$this->Semister);
		$criteria->compare('Catagery',$this->Catagery,true);
		$criteria->compare('Cradit',$this->Cradit);
		$criteria->compare('Assement',$this->Assement,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}