<?php

/**
 * This is the model class for table "distinction_criteria".
 *
 * The followings are the available columns in table 'distinction_criteria':
 * @property integer $id
 * @property integer $unit_id
 * @property string $criteria_no
 * @property string $criteria_title
 *
 * The followings are the available model relations:
 * @property DistCriteriaItem[] $distCriteriaItems
 * @property TblModule $unit
 */
class DistinctionCriteria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DistinctionCriteria the static model class
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
		return 'distinction_criteria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_id, criteria_no, criteria_title', 'required'),
			array('unit_id', 'numerical', 'integerOnly'=>true),
			array('criteria_no', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, unit_id, criteria_no, criteria_title', 'safe', 'on'=>'search'),
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
			'distCriteriaItems' => array(self::HAS_MANY, 'DistCriteriaItem', 'distn_id'),
			'unit' => array(self::BELONGS_TO, 'TblModule', 'unit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'unit_id' => 'Unit',
			'criteria_no' => 'Criteria No',
			'criteria_title' => 'Criteria Title',
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
		$criteria->compare('unit_id',$this->unit_id);
		$criteria->compare('criteria_no',$this->criteria_no,true);
		$criteria->compare('criteria_title',$this->criteria_title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}