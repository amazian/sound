<?php

class ProductsController extends BackendController {

    public function actionIndex($productName = false, $categoryId = false, $sortBy = 'name', $sortOrder = 'ASC') {
        $criteria = new CDbCriteria;
        $criteria->with = array( 'description' );

        // sort by
        $sortOrder = ($sortOrder == 'ASC') ? 'ASC' : 'DESC';
        if($sortBy == 'name')
            $criteria->order = "description.name {$sortOrder}";
        elseif($sortBy == 'type' || $sortBy == 'model' || $sortBy == 'price')
            $criteria->order = "{$sortBy} {$sortOrder}";

        $products = Product::model()->findAll($criteria);
        $filteredProducts = array();
        foreach($products as $p) {
            if($productName && !empty($productName)){
                if(stripos($p->description->name,$productName) !== false)
                    $filteredProducts[] = $p;
            }
            elseif($categoryId && !empty($categoryId)){
                $categories = $p->categories;
                foreach($categories as $c){
                    if($c->category_id == $categoryId){
                        $filteredProducts[] = $p;
                        break;
                    }
                }
            }
            else
                $filteredProducts[] = $p;
                
        }
        
        $categories = Category::model()->findAllByAttributes(array('parent_id'=>0));
        $categoryOptions = array();
        foreach($categories as $category){
            $categoryOptions[$category->category_id] = $category->description->name;
        }
        
        $this->render('index', array(
            'products'=>$filteredProducts,
            'categories'=>$categoryOptions,
            'sortOrder'=>$sortOrder,
            'sortBy'=>$sortBy
        ));
    }
    
    public function actionCreate(){
        $model = new ProductForm;
        if (isset($_POST['ProductForm'])) {
            $model->attributes = $_POST['ProductForm'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('index'));
            }
        }
        
        $statuses = array(
            0=>Yii::t('common', 'Disabled'),
            1=>Yii::t('common', 'Enabled')
        );
        
        $taxClasses = TaxClass::model()->findAll();
        $taxClassesList = array();
        foreach($taxClasses as $taxClass) $taxClassesList[$taxClass->tax_class_id] = $taxClass->title;
        
        $yes_no = array(
            0=>Yii::t('common', 'No'),
            1=>Yii::t('common', 'Yes')
        );
        
        $taxClasses = TaxClass::model()->findAll();
        $taxClassesList = array();
        foreach($taxClasses as $taxClass) $taxClassesList[$taxClass->tax_class_id] = $taxClass->title;
        
        // TODO: add language
        $stockStatuses = StockStatus::model()->findAll();
        $stockStatusesList = array();
        foreach($stockStatuses as $stockStatus) $stockStatusesList[$stockStatus->stock_status_id] = $stockStatus->name;
        
        // TODO: add language
        $weightClasses = WeightClass::model()->findAll();
        $weightClassesList = array();
        foreach($weightClasses as $weightClass) $weightClassesList[$weightClass->weight_class_id] = $weightClass->description->title;
        
        // TODO: add language
        $lengthClasses = LengthClass::model()->findAll();
        $lengthClassesList = array();
        foreach($lengthClasses as $lengthClass) $lengthClassesList[$lengthClass->length_class_id] = $lengthClass->description->title;
        
        // Specs
        $specs = Spec::model()->findAll();
        $specs = CHtml::listData($specs, 'spec_id', 'name');
        
        // Units
        $units = Unit::model()->findAll();
        $units = CHtml::listData($units, 'unit_id', 'name');
        
        $this->render('create', array(
            'model'=>$model,
            'statuses'=>$statuses,
            'taxClasses'=>$taxClassesList,
            'yes_no'=>$yes_no,
            'stockStatuses'=>$stockStatusesList,
            'weightClasses'=>$weightClassesList,
            'lengthClasses'=>$lengthClassesList,
            'specs'=>$specs,
            'units'=>$units,
        ));
    }
    
    public function actionUpdate($id){
        $model = new ProductForm;
        if (isset($_POST['ProductForm'])) {
            $model->attributes = $_POST['ProductForm'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('index'));
            }
        }
        else
            $model->loadDataFromProduct($id);
        
        $statuses = array(
            0=>Yii::t('common', 'Disabled'),
            1=>Yii::t('common', 'Enabled')
        );
        
        $yes_no = array(
            0=>Yii::t('common', 'No'),
            1=>Yii::t('common', 'Yes')
        );
        
        $taxClasses = TaxClass::model()->findAll();
        $taxClassesList = array();
        foreach($taxClasses as $taxClass) $taxClassesList[$taxClass->tax_class_id] = $taxClass->title;
        
        // TODO: add language
        $stockStatuses = StockStatus::model()->findAll();
        $stockStatusesList = array();
        foreach($stockStatuses as $stockStatus) $stockStatusesList[$stockStatus->stock_status_id] = $stockStatus->name;
        
        // TODO: add language
        $weightClasses = WeightClass::model()->findAll();
        $weightClassesList = array();
        foreach($weightClasses as $weightClass) $weightClassesList[$weightClass->weight_class_id] = $weightClass->description->title;
        
        // TODO: add language
        $lengthClasses = LengthClass::model()->findAll();
        $lengthClassesList = array();
        foreach($lengthClasses as $lengthClass) $lengthClassesList[$lengthClass->length_class_id] = $lengthClass->description->title;
        
        // Specs
        $specs = Spec::model()->findAll();
        $specs = CHtml::listData($specs, 'spec_id', 'name');
        
        // Units
        $units = Unit::model()->findAll();
        $units = CHtml::listData($units, 'unit_id', 'name');
        $units[0] = '';
        
        $this->render('update', array(
            'model'=>$model,
            'statuses'=>$statuses,
            'taxClasses'=>$taxClassesList,
            'yes_no'=>$yes_no,
            'stockStatuses'=>$stockStatusesList,
            'weightClasses'=>$weightClassesList,
            'lengthClasses'=>$lengthClassesList,
            'specs'=>$specs,
            'units'=>$units,
        ));        
    }

    public function actionGetBrandPhotoUrl($brand) {
        $manufacturer = Manufacturer::model()->findByPk($brand);
        if(!is_null($manufacturer))
            echo $manufacturer->getImageWithSize(80, 80);
    }
    
    public function actionDelete($ids){
        $ids = explode(',', $ids);
        if(count($ids) > 0){
            foreach($ids as $id){
                $product = Product::model()->findByPk($id);
                $product->delete();
            }
        }
        
        $this->redirect(array('index'));
    }
    
    public function actionAutocomplete($query){     
        $json = array();
        $descriptions = ProductDescription::model()->findAll("name LIKE '%{$query}%' ");
        foreach($descriptions as $description){
            $json[] = array('id'=>$description->product_id, 'value'=>$description->name);
        }
        
        echo CJSON::encode($json);
    }
    
    public function actionAddCategoryDownList($categoryId, $form = true){
        $category = Category::model()->findByPk($categoryId);
        
        $categories = array();
        if($category->hasChildCategories())
            $categories = $category->childCategories;
        else 
            return;

        $descriptions = array();
        foreach($categories as $cat) $descriptions[] = $cat->description;
        $values = CHtml::listData($descriptions, 'category_id', 'name');
        $values[0] = '';
        
        if($form) {
            $model = new ProductForm;
            echo CHtml::activeDropDownList($model, 'categories[]', $values, array('class'=>'categoryDropDownList'));
        }
        else{
            echo CHtml::dropDownList('categoryId', null, $values, array('class'=>'categoryDropDownList'));
        }
    }

}