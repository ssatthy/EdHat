<?php

/**
 * This is the model class for table "dist_criteria_item".
 *
 * The followings are the available columns in table 'dist_criteria_item':
 * @property integer $id
 * @property integer $distn_id
 * @property string $item_no
 * @property string $title
 *
 * The followings are the available model relations:
 * @property DcriteriaGrade[] $dcriteriaGrades
 * @property DistinctionCriteria $distn
 */
class DistCriteriaItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DistCriteriaItem the static model class
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
		return 'dist_criteria_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('distn_id, item_no, title', 'required'),
			array('distn_id', 'numerical', 'integerOnly'=>true),
			array('item_no', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, distn_id, item_no, title', 'safe', 'on'=>'search'),
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
			'dcriteriaGrades' => array(self::HAS_MANY, 'DcriteriaGrade', 'criteria_id'),
			'distn' => array(self::BELONGS_TO, 'DistinctionCriteria', 'distn_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'distn_id' => 'Distn',
			'item_no' => 'Item No',
			'title' => 'Title',
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
		$criteria->compare('distn_id',$this->distn_id);
		$criteria->compare('item_no',$this->item_no,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}