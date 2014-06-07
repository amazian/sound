<?php

class OrdersController extends BackendController {

    public function actionIndex() {
        $orders = Order::model()->findAll();

        $orderStatuses = array(
            Order::STATUS_PENDING_PAYMENT => 'Pending Payment',
            Order::STATUS_PROCESSING => 'Processing',
            Order::STATUS_CANCELED => 'Canceled',
            ORDER::STATUS_SHIPPED => 'Shipped',
            ORDER::STATUS_COMPLETED => 'Completed',
        );

        $this->render('index', array(
            'orders'=>$orders,
            'orderStatuses'=>$orderStatuses,
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

    public function actionSaveStatus() {
        $order = Order::model()->findByPk($_POST['id']);
        $status = $_POST['status'];

        $order->order_status_id = $status;

        $order->save();
    }

}