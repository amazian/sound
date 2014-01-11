<?php


class TopSalesForm extends CFormModel {

    public $products;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('products', 'numerical'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'products'=>Yii::t('topSales', 'Products'),
        );
    }

}