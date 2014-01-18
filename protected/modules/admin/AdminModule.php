<?php
class AdminModule extends CWebModule {

    public function init() {
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {

            // Make 'admin' the main user in this module.
            Yii::app()->setComponent('user', Yii::app()->admin);
            Yii::app()->setComponent('admin', Yii::app()->admin);

            return true;
        }
        else
            return false;
    }

}
