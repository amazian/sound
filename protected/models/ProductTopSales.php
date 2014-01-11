<?php

/**
 * This is the model class for table "product_topsales".
 *
 * The followings are the available columns in table 'product_topsales':
 * @property integer $product_id
 */
class ProductTopSales extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductTopSales the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_topsales';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('product_id', 'required'),
            array('product_id', 'numerical', 'integerOnly' => true),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'product'=>array(self::BELONGS_TO, 'Product', 'product_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'product_id' => 'Product',
        );
    }

}