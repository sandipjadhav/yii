<?php

/**
 * This is the model class for table "Car".
 *
 * The followings are the available columns in table 'Car':
 * @property integer $ID
 * @property string $StyleID
 * @property string $Price
 * @property string $Make
 * @property string $Model
 * @property string $Year
 *
 * The followings are the available model relations:
 * @property Deal[] $deals
 * @property DealHistory[] $dealHistories
 * @property SavedCars[] $savedCars
 */
class Car extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Car';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID', 'required'),
			array('ID', 'numerical', 'integerOnly'=>true),
			array('StyleID, Price', 'length', 'max'=>100),
			array('Make, Model, Year', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, StyleID, Price, Make, Model, Year', 'safe', 'on'=>'search'),
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
			'deals' => array(self::HAS_MANY, 'Deal', 'Car_ID'),
			'dealHistories' => array(self::HAS_MANY, 'DealHistory', 'Car_ID'),
			'savedCars' => array(self::HAS_MANY, 'SavedCars', 'Car_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'StyleID' => 'Style',
			'Price' => 'Price',
			'Make' => 'Make',
			'Model' => 'Model',
			'Year' => 'Year',
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
		$criteria->compare('StyleID',$this->StyleID,true);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('Make',$this->Make,true);
		$criteria->compare('Model',$this->Model,true);
		$criteria->compare('Year',$this->Year,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Car the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
