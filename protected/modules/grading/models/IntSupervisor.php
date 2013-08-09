<?php

/**
 * This is the model class for table "int_supervisor".
 *
 * The followings are the available columns in table 'int_supervisor':
 * @property string $intsupervisor
 * @property integer $center_id
 */
class IntSupervisor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IntSupervisor the static model class
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
		return 'int_supervisor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('intsupervisor, center_id', 'required'),
			array('center_id', 'numerical', 'integerOnly'=>true),
			array('intsupervisor', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('intsupervisor, center_id', 'safe', 'on'=>'search'),
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
			'intsupervisor' => 'Intsupervisor',
			'center_id' => 'Center',
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

		$criteria->compare('intsupervisor',$this->intsupervisor,true);
		$criteria->compare('center_id',$this->center_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}