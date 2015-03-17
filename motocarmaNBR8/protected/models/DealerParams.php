<?php

/**
 * This is the model class for table "DealerParams".
 *
 * The followings are the available columns in table 'DealerParams':
 * @property integer $id
 * @property integer $DealerId
 * @property string $DocFee
 * @property string $Smog
 * @property string $SmogCertFee
 * @property string $TireFee
 * @property string $DmvEt
 * @property string $DmvAddiFee
 * @property string $LicenseFee
 * @property string $SalesTax
 */
class DealerParams extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'DealerParams';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DealerId', 'required'),
			array('DealerId', 'numerical', 'integerOnly'=>true),
			array('DocFee, Smog, SmogCertFee, TireFee, DmvEt, DmvAddiFee, LicenseFee, SalesTax', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, DealerId, DocFee, Smog, SmogCertFee, TireFee, DmvEt, DmvAddiFee, LicenseFee, SalesTax', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'DealerId' => 'Dealer',
            'DocFee' => 'Documentation Fee',
            'Smog' => 'Smog',
            'SmogCertFee' => 'Smog Cert Fee',
            'TireFee' => 'Tire Fee',
            'DmvEt' => 'DMV ET',
            'DmvAddiFee' => 'DMV Additional Fee',
            'LicenseFee' => 'License Fee',
            'SalesTax' => 'Sales Tax',
            'CounterOffer' => 'Counter Offer',
            'OfferPrice' => 'Offer Price',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('DealerId',$this->DealerId);
		$criteria->compare('DocFee',$this->DocFee,true);
		$criteria->compare('Smog',$this->Smog,true);
		$criteria->compare('SmogCertFee',$this->SmogCertFee,true);
		$criteria->compare('TireFee',$this->TireFee,true);
		$criteria->compare('DmvEt',$this->DmvEt,true);
		$criteria->compare('DmvAddiFee',$this->DmvAddiFee,true);
		$criteria->compare('LicenseFee',$this->LicenseFee,true);
		$criteria->compare('SalesTax',$this->SalesTax,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DealerParams the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
