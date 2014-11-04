<?php

/**
 * This is the model class for table "DealHistory".
 *
 * The followings are the available columns in table 'DealHistory':
 * @property integer $ID
 * @property integer $Car_ID
 * @property integer $Deal_ID
 * @property integer $DealStatus_ID
 * @property integer $SalesPerson_ID
 * @property integer $User_ID
 * @property string $DealStatus
 * @property string $Make
 * @property string $Model
 * @property string $Price
 * @property string $SalesPersonUserName
 * @property string $StyleID
 * @property string $Year
 * @property string $UserName
 *
 * The followings are the available model relations:
 * @property Car $car
 * @property Deal $deal
 * @property DealStatus $dealStatus
 * @property SalesPerson $salesPerson
 * @property Users $user
 */
class DealHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'DealHistory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Deal_ID', 'required'),
			array('ID, Car_ID, Deal_ID, DealStatus_ID, SalesPerson_ID, User_ID', 'numerical', 'integerOnly'=>true),
			array('DealStatus, Make, Model, Price, SalesPersonUserName, StyleID, Year, UserName', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Car_ID, Deal_ID, DealStatus_ID, SalesPerson_ID, User_ID, DealStatus, Make, Model, Price, SalesPersonUserName, StyleID, Year, UserName', 'safe', 'on'=>'search'),
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
			'car' => array(self::BELONGS_TO, 'Car', 'Car_ID'),
			'deal' => array(self::BELONGS_TO, 'Deal', 'Deal_ID'),
			'dealStatus' => array(self::BELONGS_TO, 'DealStatus', 'DealStatus_ID'),
			'salesPerson' => array(self::BELONGS_TO, 'SalesPerson', 'SalesPerson_ID'),
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
			'Car_ID' => 'Car',
			'Deal_ID' => 'Deal',
			'DealStatus_ID' => 'Deal Status',
			'SalesPerson_ID' => 'Sales Person',
			'User_ID' => 'User',
			'DealStatus' => 'Deal Status',
			'Make' => 'Make',
			'Model' => 'Model',
			'Price' => 'Price',
			'SalesPersonUserName' => 'Sales Person User Name',
			'StyleID' => 'Style',
			'Year' => 'Year',
			'UserName' => 'User Name',
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
		$criteria->compare('Car_ID',$this->Car_ID);
		$criteria->compare('Deal_ID',$this->Deal_ID);
		$criteria->compare('DealStatus_ID',$this->DealStatus_ID);
		$criteria->compare('SalesPerson_ID',$this->SalesPerson_ID);
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('DealStatus',$this->DealStatus,true);
		$criteria->compare('Make',$this->Make,true);
		$criteria->compare('Model',$this->Model,true);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('SalesPersonUserName',$this->SalesPersonUserName,true);
		$criteria->compare('StyleID',$this->StyleID,true);
		$criteria->compare('Year',$this->Year,true);
		$criteria->compare('UserName',$this->UserName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        // If this is modified, also modify it in SalesPerson and SavedCars model.
        public function getAllCars()
        {
            $model = Car::model()->findAll(array('order'=>'Make'));
            $list = CHtml::listdata($model,'ID','Make');
            return $list;
        }
        
         // Get Deal statsus
        public function getAllDealStatus()
        { 
            $model = DealStatus::model()->findAll(array('order'=>'DealStatus'));
            $list = CHtml::listdata($model,'ID','DealStatus');
            return $list;
        }
        
        // Get Users
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
	 * @return DealHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
