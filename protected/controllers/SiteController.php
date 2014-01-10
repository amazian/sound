<?php

class SiteController extends Controller {

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $categories = Category::model()->findAllByAttributes(array('parent_id'=>0));
        
        $this->render('index', array( 
            'categories'=>$categories
        ));
    }
    
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionAbout() {
        $this->render('about');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Fills the JS tree on an AJAX request.
     * Should receive parent node ID in $_GET['root'],
     *  with 'source' when there is no parent.
     */
    public function actionAjaxFillTree()
    {
        // accept only AJAX request (comment this when debugging)
        if (!Yii::app()->request->isAjaxRequest) {
            //exit();
        }
        // parse the user input
        $parentId = "0";
        if (isset($_GET['node'])) {
            $parentId = (int) $_GET['node'];
        }

        $children = $this->getTreeDataForCategoryId($parentId);

        echo CTreeView::saveDataAsJson($children);
    }

    private function getTreeDataForCategoryId($categoryId) {
        // read the data (this could be in a model)
        $children = Yii::app()->db->createCommand(
            "SELECT m3.name AS label, m1.category_id AS id, m2.category_id IS NOT NULL AS children "
            . "FROM category AS m1 LEFT JOIN category AS m2 ON m1.category_id=m2.parent_id, category_description AS m3 "
            . "WHERE m1.parent_id <=> $categoryId AND m1.category_id=m3.category_id "
            . "GROUP BY m1.category_id "
            . "ORDER BY m1.sort_order, m1.date_added ASC"
        )->queryAll();

        foreach($children as $id => $child) {
            if($child['children'] != 0)
                $children[$id]['children'] = $this->getTreeDataForCategoryId($child['id']);
            else
                $children[$id]['children'] = array();
        }

        return $children;
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}