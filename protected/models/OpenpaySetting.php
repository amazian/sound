<?php

/**
 * This is the model class for table "openpay_setting".
 *
 * The followings are the available columns in table 'openpay_setting':
 * @property integer $id
 * @property string $mid
 * @property string $api_key1
 * @property string $api_key2
 * @property integer $sandbox
 * @property string $language
 * @property string $return_url
 * @property string $cancel_url
 * @property string $notify_url
 */
class OpenpaySetting extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'openpay_setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid', 'length', 'max'=>256),
			array('language', 'length', 'max'=>256),
			array('return_url, cancel_url, notify_url, api_key1, api_key2', 'length', 'max'=>256),
            array('sandbox', 'length', 'max'=>1),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
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
			'mid' => 'Mid',
            'api_key1' => 'API Key 1',
            'api_key2' => 'API Key 2',
            'sandbox' => 'Sandbox',
			'language' => 'Language',
			'return_url' => 'Return Url',
			'cancel_url' => 'Cancel Url',
			'notify_url' => 'Notify Url',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OpenpaySetting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
