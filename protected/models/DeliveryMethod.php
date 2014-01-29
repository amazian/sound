<?php

/**
 * This is the model class for table "delivery_methods".
 *
 * The followings are the available columns in table 'delivery_methods':
 * @property integer $delivery_method_id
 * @property string $text
 */
class DeliveryMethod extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'delivery_methods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text', 'required'),
			array('text', 'length', 'max'=>255),
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
			'delivery_method_id' => 'Delivery Method',
			'text' => 'Text',
		);
	} 

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DeliveryMethod the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
