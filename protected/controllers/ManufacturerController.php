<?php

class ManufacturerController extends Controller {

    public function actionIndex($id) {
        $manufacturer = Manufacturer::model()->findByPk($id);
        if(is_null($manufacturer)) {
            return;
        }

        $this->render('index', array(
            'manufacturer'=>$manufacturer
        ));
    }

}