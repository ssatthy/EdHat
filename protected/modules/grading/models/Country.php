<?php

/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property integer $country_id
 * @property string $country_name
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Center[] $centers
 * @property User[] $users
 */
class Country extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
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
		return 'country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id', 'required'),
			array('country_id', 'numerical', 'integerOnly'=>true),
			array('country_name, status', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('country_id, country_name, status', 'safe', 'on'=>'search'),
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
			'centers' => array(self::HAS_MANY, 'Center', 'country_id'),
			'users' => array(self::MANY_MANY, 'User', 'ext_supervisor(country_id, extsupervisor)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'country_id' => 'Country',
			'country_name' => 'Country Name',
			'status' => 'Status',
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
                $criteria->join='LEFT JOIN ext_supervisor ON ext_supervisor.country_id=t.country_id';
                $criteria->condition='ext_supervisor.extsupervisor=:value';
                $criteria->params=array(':value'=>Yii::app()->user->id);
                
		$criteria->compare('t.country_id',$this->country_id);
		$criteria->compare('country_name',$this->country_name,true);
		$criteria->compare('status',$this->status,true);
                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}