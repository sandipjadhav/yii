<?php

/**
 * This is the model class for table "SearchHistory".
 *
 * The followings are the available columns in table 'SearchHistory':
 * @property integer $ID
 * @property integer $User_ID
 * @property string $Make
 * @property string $Model
 * @property string $Year
 * @property string $StyleID
 * @property string $MileageCity
 * @property string $MileageHighway
 * @property string $Price
 * @property string $Trim
 * @property string $DateAdded
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class SearchHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'SearchHistory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, User_ID', 'required'),
			array('ID, User_ID', 'numerical', 'integerOnly'=>true),
			array('Make, Model, Year, StyleID, MileageCity, MileageHighway, Price, Trim, DateAdded', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, User_ID, Make, Model, Year, StyleID, MileageCity, MileageHighway, Price, Trim, DateAdded', 'safe', 'on'=>'search'),
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
			'User_ID' => 'User',
			'Make' => 'Make',
			'Model' => 'Model',
			'Year' => 'Year',
			'StyleID' => 'Style',
			'MileageCity' => 'Mileage City',
			'MileageHighway' => 'Mileage Highway',
			'Price' => 'Price',
			'Trim' => 'Trim',
			'DateAdded' => 'Date Added',
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
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('Make',$this->Make,true);
		$criteria->compare('Model',$this->Model,true);
		$criteria->compare('Year',$this->Year,true);
		$criteria->compare('StyleID',$this->StyleID,true);
		$criteria->compare('MileageCity',$this->MileageCity,true);
		$criteria->compare('MileageHighway',$this->MileageHighway,true);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('Trim',$this->Trim,true);
		$criteria->compare('DateAdded',$this->DateAdded,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        // If this is modified, also modify it in SalesPerson and Deal model.
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
	 * @return SearchHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
