<?php

/**
 * This is the model class for table "dcriteria_grade".
 *
 * The followings are the available columns in table 'dcriteria_grade':
 * @property integer $id
 * @property integer $criteria_id
 * @property integer $cwork_id
 * @property string $grade
 * @property string $page_no
 * @property string $feedback
 * @property string $verifier_id
 * @property integer $verifier_type
 *
 * The followings are the available model relations:
 * @property DistCriteriaItem $criteria
 * @property CourseWork $cwork
 * @property User $verifier
 */
class DcriteriaGrade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DcriteriaGrade the static model class
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
		return 'dcriteria_grade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('criteria_id, cwork_id, grade, page_no, feedback, verifier_id, verifier_type', 'required'),
			array('criteria_id, cwork_id, verifier_type', 'numerical', 'integerOnly'=>true),
			array('grade', 'length', 'max'=>45),
			array('page_no', 'length', 'max'=>10),
			array('verifier_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, criteria_id, cwork_id, grade, page_no, feedback, verifier_id, verifier_type', 'safe', 'on'=>'search'),
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
			'criteria' => array(self::BELONGS_TO, 'DistCriteriaItem', 'criteria_id'),
			'cwork' => array(self::BELONGS_TO, 'CourseWork', 'cwork_id'),
			'verifier' => array(self::BELONGS_TO, 'User', 'verifier_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'criteria_id' => 'Criteria',
			'cwork_id' => 'Cwork',
			'grade' => 'Grade',
			'page_no' => 'Page No',
			'feedback' => 'Feedback',
			'verifier_id' => 'Verifier',
			'verifier_type' => 'Verifier Type',
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
		$criteria->compare('criteria_id',$this->criteria_id);
		$criteria->compare('cwork_id',$this->cwork_id);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('page_no',$this->page_no,true);
		$criteria->compare('feedback',$this->feedback,true);
		$criteria->compare('verifier_id',$this->verifier_id,true);
		$criteria->compare('verifier_type',$this->verifier_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}