<?php

class DefaultController extends BackendController {    

    public function actionIndex() {
        if(Yii::app()->admin->isGuest)
            $this->redirect(array('/admin/login'));
        else
            $this->render('index');
    }
}