<?php

/**
 * This is the model class for table "Dealership".
 *
 * The followings are the available columns in table 'Dealership':
 * @property integer $ID
 * @property string $Name
 * @property string $Address
 * @property string $Email
 * @property string $WorkPhone
 * @property string $WorkPhone2
 * @property string $Fax
 * @property string $Website
 * @property string $Description
 * @property integer $Active
 * @property string $Photo
 * @property string $DateAdded
 *
 * The followings are the available model relations:
 * @property DealerMake[] $dealerMakes
 * @property Users $user
 * @property SalesPerson[] $salesPeople
 */
class Dealership extends CActiveRecord
{
     public $User_ID;
     public $username;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Dealership';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('User_ID', 'required'),
            array('Active, User_ID, zip', 'numerical', 'integerOnly' => true),
			array('Name', 'length', 'max'=>255),
			array('Address', 'length', 'max'=>1000),
            array('Email, city ,', 'length', 'max' => 100),
            array('street', 'length', 'max' => 200),
			array('WorkPhone, WorkPhone2, Fax', 'length', 'max'=>15),
			array('Website', 'length', 'max'=>50),
            array('State', 'length', 'max' => 20),
			array('Description', 'length', 'max'=>500),
			array('Photo, DateAdded', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, User_ID, Name, Address, Email, WorkPhone, WorkPhone2, Fax, Website, Description, Active, Photo, DateAdded', 'safe', 'on'=>'search'),
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
            'dealerMake' => array(self::HAS_MANY, 'DealerMake', 'DealerId'),
            'salesPeople' => array(self::HAS_MANY, 'SalesPerson', 'Dealership_ID'),
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
			'Name' => 'Name',
			'Address' => 'Address',
			'Email' => 'Email',
            'street' => 'Street',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
			'WorkPhone' => 'Work Phone',
			'WorkPhone2' => 'Work Phone2',
			'Fax' => 'Fax',
			'Website' => 'Website',
			'Description' => 'Description',
			'Active' => 'Active',
			'Photo' => 'Photo',
			'DateAdded' => 'Date Added',
		);
	}

        // If this is modified, also modify it in SalesPerson and SavedCars model.
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
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Email',$this->Email,true);
        $criteria->compare('street', $this->street, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('state', $this->state);
        $criteria->compare('zip', $this->zip);
		$criteria->compare('WorkPhone',$this->WorkPhone,true);
		$criteria->compare('WorkPhone2',$this->WorkPhone2,true);
		$criteria->compare('Fax',$this->Fax,true);
		$criteria->compare('Website',$this->Website,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Active',$this->Active);
		$criteria->compare('Photo',$this->Photo,true);
		$criteria->compare('DateAdded',$this->DateAdded,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dealership the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getDealerAddress()
    {
        return $this->street . ", " . $this->city . ", " . $this->state . ", " . $this->zip;
    }

    public function getDealerName()
    {
        $dealerName = '';
        if ($this->user->profile) {
            $dealerName = $this->user->profile->getAttribute('firstname') . " " . $this->user->profile->getAttribute('lastname');
        }
        $dealerName = trim($dealerName) == '' ? $this->Name : trim($dealerName);
        return $dealerName;

    }
}
