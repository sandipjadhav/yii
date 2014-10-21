<?php

/**
 * This is the model class for table "SavedCars".
 *
 * The followings are the available columns in table 'SavedCars':
 * @property integer $ID
 * @property integer $Car_ID
 * @property integer $DealStatus_ID
 * @property integer $User_ID
 * @property integer $DateAdded
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Car $car
 * @property SavedCars $dealStatus
 * @property SavedCars[] $savedCars
 */
class SavedCars extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'SavedCars';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Car_ID, User_ID', 'required'),
			array('ID, Car_ID, DealStatus_ID, User_ID, DateAdded', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Car_ID, DealStatus_ID, User_ID, DateAdded', 'safe', 'on'=>'search'),
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
			'car' => array(self::BELONGS_TO, 'Car', 'Car_ID'),
			'dealStatus' => array(self::BELONGS_TO, 'DealStatus', 'DealStatus_ID'),
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
			'DealStatus_ID' => 'Deal Status',
			'User_ID' => 'User',
			'DateAdded' => 'Date Added',
		);
	}

        // If this is modified, also modify it in SalesPerson and Deal models.
        public function getAllDealStatus()
        {
            $model = DealStatus::model()->findAll(array('order'=>'DealStatus'));
            $list = CHtml::listdata($model,'ID','DealStatus');
            return $list;
        }
        
        // If this is modified, also modify it in SalesPerson and Deal model.
        public function getAllCars()
        {
            $model = Car::model()->findAll(array('order'=>'Make'));
            $list = CHtml::listdata($model,'ID','Make');
            return $list;
        }
        
        // If this is modified, also modify it in SalesPerson and Deal model.
        public function getAllUsers()
        {
            $model = User::model()->findAll(array('order'=>'username'));
            $list = CHtml::listdata($model,'id','username');
            return $list;
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
		$criteria->compare('DealStatus_ID',$this->DealStatus_ID);
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('DateAdded',$this->DateAdded);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SavedCars the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
