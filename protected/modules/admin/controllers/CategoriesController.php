<?php

class CategoriesController extends BackendController {

    public function actionIndex() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'parent_id=0';
        $criteria->order = 'sort_order, date_added ASC';
        $categories = Category::model()->findAll($criteria);
        
        $this->render('index', array(
            'categories'=>$categories            
        ));
    }
    
    public function actionCreate(){
        $model = new CategoryForm;
        if (isset($_POST['CategoryForm'])) {
            $model->attributes = $_POST['CategoryForm'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('index'));
            }
        }
        
        $statuses = array(
            0=>Yii::t('common', 'Disabled'),
            1=>Yii::t('common', 'Enabled')
        );
        
        $stores = CHtml::listData(Store::model()->findAll(), 'store_id' , 'name');
        $stores[0] = Yii::t('store', 'Default');
        
        $this->render('create', array(
            'model'=>$model,
            'stores'=>$stores,
            'statuses'=>$statuses
        ));
    }
    
    public function actionUpdate($id){
        $model = new CategoryForm;
        if (isset($_POST['CategoryForm'])) {
            $model->attributes = $_POST['CategoryForm'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('index'));
            }
        }
        else
            $model->loadDataFromCategory($id);

        $statuses = array(
            0=>Yii::t('common', 'Disabled'),
            1=>Yii::t('common', 'Enabled')
        );
        
        $stores = CHtml::listData(Store::model()->findAll(), 'store_id' , 'name');
        $stores[0] = Yii::t('store', 'Default');
        
        $this->render('update', array(
            'model'=>$model,
            'stores'=>$stores,
            'statuses'=>$statuses
        ));        
    }
    
    public function actionDelete($ids){
        $ids = explode(',', $ids);
        if(count($ids) > 0){
            foreach($ids as $id){
                $category = Category::model()->findByPk($id);
                if(!is_null($category))
                    $category->delete();
            }
        }
        
        $this->redirect(array('index'));
    }
    
    public function actionAutocomplete($query, $categoryId = false){
        $json = array();
        
        // TODO: add locale
        $language_id = 1;
        $descriptions = CategoryDescription::model()->findAll("name LIKE '%{$query}%' AND language_id={$language_id}");
        foreach($descriptions as $description){
            // ignore parent category and childs, wtf? NOTE: this was requested on Correction_sound#1_7.26
            // : a) Parent's autocomplete droplist: SET IT as do not show self and self's child as an option.
            if($categoryId){
                $category = Category::model()->findByPk($categoryId);
                if(!is_null($category)) {
                    $childLevel = $category->getMaxChildLevel() - $category->getLevel();
                    $parentLevel = $description->category->getLevel();

                    if(($parentLevel + $childLevel + 1) >= 3) {
                        continue;
                    }
                }
            }

            if(!$description->category->isBottomMost() && !$description->category->hasDirectProducts())
                $json[] = array('id'=>$description->category_id, 'value'=>$description->category->getFullname());
        }
        
        // add no-parent
        array_unshift($json, array('id'=>0, 'value'=>Yii::t('categories', 'No parent')));
        
        echo CJSON::encode($json);
    }
    

}