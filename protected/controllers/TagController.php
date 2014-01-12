<?php

class TagController extends Controller {

    public function actionIndex($text) {
        $productTags = ProductTag::model()->findAllByAttributes(array('tag_text'=>$text));

        $this->render('index', array(
            'productTags'=>$productTags,
            'tagText'=>$text
        ));
    }

}