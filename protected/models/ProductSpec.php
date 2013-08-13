<?php

/**
 * This is the model class for table "product_spec".
 *
 * The followings are the available columns in table 'product_spec':
 * @property integer $product_spec_id
 * @property integer $product_id
 * @property integer $spec_id
 * @property integer $unit_id
 * @property string $value_init
 * @property string $value_end
 */
class ProductSpec extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductSpec the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_spec';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('product_id, spec_id, unit_id, value_init', 'required'),
            array('product_id, spec_id, unit_id', 'numerical', 'integerOnly' => true),
            array('value_end', 'safe')
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'description'=>array(self::BELONGS_TO, 'Spec', 'spec_id'),
            'unit'=>array(self::BELONGS_TO, 'Unit', 'unit_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'product_id' => 'Product',
            'spec_id' => 'Spec',
            'unit_id' => 'Unit',
            'value_init' => 'Value Init',
            'value_end' => 'Value End',
        );
    }

}