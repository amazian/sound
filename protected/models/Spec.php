<?php

/**
 * This is the model class for table "spec".
 *
 * The followings are the available columns in table 'spec':
 * @property string $spec_id
 * @property string $name
 * @property integer $type_id
 */
class Spec extends CActiveRecord {

    const TYPE_NUMERICAL = 1;
    const TYPE_ALPHABETICAL = 2;
    
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
            array('name, type_id', 'required'),
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
            'type_id' => 'Type',
        );
    }
    
    public function getType(){
        switch ($this->type_id){
            case self::TYPE_NUMERICAL:
                return 'Numerical';
                break;
            case self::TYPE_ALPHABETICAL:
                return 'Alphabetical';
                break;
            default:
                return '##Invalid##';
                break;
        }
    }

    public function getSpecOptions() {
        // this is only used for non-numeric specs
        if($this->type_id == self::TYPE_NUMERICAL) return;

        // read the data (this could be in a model)
        $specValues = Yii::app()->db->createCommand(
            "SELECT m1.value_init AS name "
            . "FROM product_spec AS m1 "
            . "WHERE m1.spec_id = {$this->spec_id} "
            . "GROUP BY m1.value_init "
            . "ORDER BY m1.value_init ASC"
        )->queryAll();

        $options = array();
        foreach($specValues as $value) {
            $val = $value['name'];
            $options[$val] = $val;
        }

        return $options;
    }

}