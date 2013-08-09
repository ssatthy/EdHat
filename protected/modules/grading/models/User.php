<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $userid
 * @property string $tempid
 * @property string $password
 * @property string $personalid
 * @property string $recoverymail
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Country[] $countries
 * @property Grade[] $grades
 * @property Center[] $centers
 * @property TblModule[] $tblModules
 * @property Userctg[] $userctgs
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, tempid, password, personalid, recoverymail, status', 'required'),
			array('userid', 'length', 'max'=>255),
			array('tempid, password, personalid, recoverymail, status', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, tempid, password, personalid, recoverymail, status', 'safe', 'on'=>'search'),
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
			'countries' => array(self::MANY_MANY, 'Country', 'ext_supervisor(extsupervisor, country_id)'),
			'grades' => array(self::HAS_MANY, 'Grade', 'verifier_id'),
			'centers' => array(self::MANY_MANY, 'Center', 'int_supervisor(intsupervisor, center_id)'),
			'tblModules' => array(self::MANY_MANY, 'TblModule', 'professor(professor, module_id)'),
			'userctgs' => array(self::HAS_MANY, 'Userctg', 'uname'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => 'Userid',
			'tempid' => 'Tempid',
			'password' => 'Password',
			'personalid' => 'Personalid',
			'recoverymail' => 'Recoverymail',
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

		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('tempid',$this->tempid,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('personalid',$this->personalid,true);
		$criteria->compare('recoverymail',$this->recoverymail,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}