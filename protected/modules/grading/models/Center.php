<?php

/**
 * This is the model class for table "center".
 *
 * The followings are the available columns in table 'center':
 * @property integer $centerid
 * @property string $cent_name
 * @property string $status
 * @property integer $country_id
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property TblCourse[] $tblCourses
 * @property User[] $users
 */
class Center extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Center the static model class
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
		return 'center';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('centerid, country_id', 'required'),
			array('centerid, country_id', 'numerical', 'integerOnly'=>true),
			array('cent_name, status', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('centerid, cent_name, status, country_id', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'tblCourses' => array(self::MANY_MANY, 'TblCourse', 'center_course(centerid, CourseIndex)'),
			'users' => array(self::MANY_MANY, 'User', 'int_supervisor(center_id, intsupervisor)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'centerid' => 'Center ID',
			'cent_name' => 'Center Name',
			'status' => 'Status',
			'country_id' => 'Country ID',
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
                $criteria->select = 't.*';
                $criteria->join='LEFT JOIN int_supervisor ON int_supervisor.center_id=t.centerid';
                $criteria->condition='int_supervisor.intsupervisor=:value';
                $criteria->params=array(':value'=>Yii::app()->user->id);
                
		$criteria->compare('t.centerid',$this->centerid);
		$criteria->compare('cent_name',$this->cent_name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('country_id',$this->country_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}