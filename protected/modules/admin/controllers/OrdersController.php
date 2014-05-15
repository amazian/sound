<?php

class OrdersController extends BackendController {

    public function actionIndex() {
        $orders = Order::model()->findAll();

        $this->render('index', array(
            'orders'=>$orders
        ));
    }

    public function actionRead($id) {
        $order = Order::model()->findByPk($id);
        echo $order->comment;
    }

    public function actionReadAdmin($id) {
        $order = Order::model()->findByPk($id);
        echo $order->admin_comment;
    }

    public function actionWrite() {
        $order = Order::model()->findByPk($_POST['id']);
        $note = $_POST['note'];

        $order->admin_comment = $note;
        $order->save();
    }

}