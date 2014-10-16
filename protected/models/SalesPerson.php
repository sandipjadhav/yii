<?php

/**
 * This is the model class for table "SalesPerson".
 *
 * The followings are the available columns in table 'SalesPerson':
 * @property integer $ID
 * @property integer $Dealership_ID
 * @property integer $User_ID
 * @property string $ContactPhone
 * @property string $Email
 * @property string $Description
 * @property string $DateAdded
 * @property integer $Active
 * @property string $Photo
 *
 * The followings are the available model relations:
 * @property Deal[] $deals
 * @property DealHistory[] $dealHistories
 * @property Dealership $dealership
 * @property Users $user
 */
class SalesPerson extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'SalesPerson';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, Dealership_ID, User_ID', 'required'),
			array('ID, Dealership_ID, User_ID, Active', 'numerical', 'integerOnly'=>true),
			array('ContactPhone, Email', 'length', 'max'=>45),
			array('Description', 'length', 'max'=>500),
			array('DateAdded, Photo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Dealership_ID, User_ID, ContactPhone, Email, Description, DateAdded, Active, Photo', 'safe', 'on'=>'search'),
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
			'deals' => array(self::HAS_MANY, 'Deal', 'SalesPerson_ID'),
			'dealHistories' => array(self::HAS_MANY, 'DealHistory', 'SalesPerson_ID'),
			'dealership' => array(self::BELONGS_TO, 'Dealership', 'Dealership_ID'),
			'user' => array(self::BELONGS_TO, 'User', 'User_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Dealership_ID' => 'Dealership',
			'User_ID' => 'User',
			'ContactPhone' => 'Contact Phone',
			'Email' => 'Email',
			'Description' => 'Description',
			'DateAdded' => 'Date Added',
			'Active' => 'Active',
			'Photo' => 'Photo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Dealership_ID',$this->Dealership_ID);
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('ContactPhone',$this->ContactPhone,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('DateAdded',$this->DateAdded,true);
		$criteria->compare('Active',$this->Active);
		$criteria->compare('Photo',$this->Photo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        // If this is modified, also modify it in SavedCars and SalesPerson models.
        public function getAllDealerships()
        {
            $model = Dealership::model()->findAll(array('order'=>'Name'));
            $list = CHtml::listdata($model,'ID','Name');
            return $list;
        }
        
        // If this is modified, also modify it in SavedCars and SalesPerson model.
        public function getAllUsers()
        {
            $model = User::model()->findAll(array('order'=>'username'));
            $list = CHtml::listdata($model,'id','username');
            return $list;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SalesPerson the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
