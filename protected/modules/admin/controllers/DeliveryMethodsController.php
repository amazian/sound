<?php

class DeliveryMethodsController extends BackendController {

    public function actionIndex() {
        $deliveryMethods = DeliveryMethod::model()->findAll();
        
        $this->render('index', array(
            'deliveryMethods'=>$deliveryMethods
        ));
    }
    
    public function actionAdd($text){
        $deliveryMethod = new DeliveryMethod();
        $deliveryMethod->text = $text;
        $spec->save();
        
        $this->redirect(array('index'));
    }
    
    public function actionDelete($id){
        DeliveryMethod::model()->deleteByPk($id);

        $this->redirect(array('index'));
    }

}