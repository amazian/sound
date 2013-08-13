<?php

/**
 * This is the model class for table "spec".
 *
 * The followings are the available columns in table 'spec':
 * @property string $spec_id
 * @property string $name
 */
class Spec extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Spec the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'spec';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max' => 255),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'spec_id' => 'Spec',
            'name' => 'Name',
        );
    }

}