<?php

/**
 * This is the model class for table "assignment".
 *
 * The followings are the available columns in table 'assignment':
 * @property integer $id
 * @property integer $assign_no
 * @property string $assign_name
 * @property integer $serial_order
 * @property string $source_file_path
 * @property string $description
 *
 * The followings are the available model relations:
 * @property TblModule $serialOrder
 * @property Grade[] $grades
 */
class Assignment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Assignment the static model class
	 */
         public $source;
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'assignment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('assign_no, assign_name, serial_order,student_id, source_file_path', 'required'),
			array('assign_no, serial_order', 'numerical', 'integerOnly'=>true),
			array('assign_name', 'length', 'max'=>45),
			array('student_id,source_file_path', 'length', 'max'=>255),
                        array('source', 'file', 'types'=>'jpg, gif, png,doc,zip,docx,pdf'),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, assign_no, assign_name, serial_order,student_id, source_file_path, description', 'safe', 'on'=>'search'),
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
			'serialOrder' => array(self::BELONGS_TO, 'TblModule', 'serial_order'),
                    'student' => array(self::BELONGS_TO, 'TblStudent', 'student_id'),
			'grades' => array(self::HAS_MANY, 'Grade', 'assign_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'assign_no' => 'Assign No',
			'assign_name' => 'Assign Name',
			'serial_order' => 'Module ID',
                    'student_id' => 'Student',
                        'source' => 'File',
			'source_file_path' => 'Source File Path',
			'description' => 'Description',
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
		$criteria->compare('assign_no',$this->assign_no);
		$criteria->compare('assign_name',$this->assign_name,true);
		$criteria->compare('serial_order',$this->serial_order);
                $criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('source_file_path',$this->source_file_path,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}