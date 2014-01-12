<?php

/**
 * This is the model class for table "product_tag".
 *
 * The followings are the available columns in table 'product_tag':
 * @property string $product_id
 * @property string $tag_text
 */
class ProductTag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductTag the static model class
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
		return 'product_tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, tag_text', 'required'),
			array('product_id', 'length', 'max'=>20),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'product'=>array(self::BELONGS_TO, 'Product', 'product_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Product',
			'tag_text' => 'Tag Text',
		);
	}
}