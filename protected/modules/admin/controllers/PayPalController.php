<?php

class PayPalController extends BackendController {

    public function actionIndex() {
        $model = PaypalSetting::model()->find();
        if (isset($_POST['PaypalSetting'])) {
            $model->attributes = $_POST['PaypalSetting'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('index'));
            }
        }
        
        $this->render('index', array(
            'model'=>$model
        ));
    }

}