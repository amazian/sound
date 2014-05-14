<?php

class MyAccountController extends Controller {

    public function actionIndex() {
        $this->redirect(array('orders'));
    }

    public function actionOrders() {
        if(Yii::app()->user->isGuest)  {
            $this->redirect(array('site/index'));
            die();
        }

        $email = Yii::app()->user->name;
        $customer = Customer::model()->findByAttributes(array('email'=>$email));
        if(!is_null($customer)) {
            $orders = Order::model()->findAllByAttributes(array('customer_id'=>$customer->customer_id));

            $this->render('orders', array(
                'orders'=>$orders
            ));
        }
        else {
            $this->redirect(array('site/index'));
            die();
        }
    }

    public function actionOrderDetails($id) {
        if(Yii::app()->user->isGuest)  {
            $this->redirect(array('site/index'));
            die();
        }

        $email = Yii::app()->user->name;
        $customer = Customer::model()->findByAttributes(array('email'=>$email));
        if(!is_null($customer)) {
            $order = Order::model()->findByAttributes(array('customer_id'=>$customer->customer_id, 'order_id'=>$id));

            $this->renderPartial('_orderDetails', array(
                'order'=>$order
            ));
        }
        else {
            $this->redirect(array('site/index'));
            die();
        }
    }

    public function actionInformation() {
        if(Yii::app()->user->isGuest)  {
            $this->redirect(array('site/index'));
            die();
        }

        $email = Yii::app()->user->name;
        $customer = Customer::model()->findByAttributes(array('email'=>$email));

        $model = new AccountInformationForm;
        $model->id = $customer->customer_id;

        // collect user input data
        if (isset($_POST['AccountInformationForm'])) {
            $model->attributes = $_POST['AccountInformationForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate())
                $model->save();
        }
        else {
            $model->name = $customer->name;
            $model->address = $customer->address;
            $model->phone = $customer->telephone;
        }

        $this->render('information', array(
            'model'=>$model
        ));
    }

    public function actionChangePassword() {
        if(Yii::app()->user->isGuest)  {
            $this->redirect(array('site/index'));
            die();
        }
        $email = Yii::app()->user->name;
        $customer = Customer::model()->findByAttributes(array('email'=>$email));

        $model = new ChangePasswordForm;
        $model->id = $customer->customer_id;

        // collect user input data
        if (isset($_POST['ChangePasswordForm'])) {
            $model->attributes = $_POST['ChangePasswordForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate())
                $model->save();
        }

        $this->render('changePassword', array(
            'model'=>$model
        ));
    }

}