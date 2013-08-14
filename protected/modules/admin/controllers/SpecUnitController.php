<?php

class SpecUnitController extends BackendController {

    public function actionIndex() {
        $specs = Spec::model()->findAll();
        $units = Unit::model()->findAll();
        
        $this->render('index', array(
            'specs'=>$specs,            
            'units'=>$units,
        ));
    }
    
    public function actionAddSpec($name, $type){
        $spec = new Spec;
        $spec->name = $name;
        $spec->type_id = $type;
        $spec->save();
        
        $this->redirect(array('index'));
    }
    
    public function actionDeleteSpec($id){
        Spec::model()->deleteByPk($id);        
        $this->redirect(array('index'));
    }
    
    public function actionAddUnit($name){
        $unit = new Unit;
        $unit->name = $name;
        $unit->save();
        
        $this->redirect(array('index'));
    }
    
    public function actionDeleteUnit($id){
        Unit::model()->deleteByPk($id);        
        $this->redirect(array('index'));
    }

}