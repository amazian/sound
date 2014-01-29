<?php

class OpenPayController extends BackendController {

    public function actionIndex() {
        $model = OpenpaySetting::model()->find();
        if (isset($_POST['OpenpaySetting'])) {
            $model->attributes = $_POST['OpenpaySetting'];
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