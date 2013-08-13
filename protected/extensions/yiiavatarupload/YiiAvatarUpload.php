<?php

/**
 * YiiAvatarUpload adds a simple ajax upload field and previews img on a thumb img.
 *
 * @author Richard González
 * v 0.1
 */
class YiiAvatarUpload extends CInputWidget {
    
    public $urlPost = '';
    public $urlGet = '';
    public $thumb = '#thumb';
    public $directory = '';

    public function run() {
        parent::run();

        list($name, $id) = $this->resolveNameID();

        $baseDir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($baseDir . DIRECTORY_SEPARATOR . 'assets');

        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($assets . '/ajaxupload.js', CClientScript::POS_END);

        $fieldId = '';
        if ($this->hasModel()) {
            $this->htmlOptions['id'] = 'upload';
            $this->htmlOptions['name'] = 'upload';
            
            $html  = CHtml::button('Upload', $this->htmlOptions);
            $html .= CHtml::activeHiddenField($this->model, $this->attribute);
            $fieldId = CHtml::activeId($this->model, $this->attribute);
        }
        else
            die();
        
        $js = <<<EOP
        new AjaxUpload('#upload', {
            action: '{$this->urlPost}',
            name: 'image',
            autoSubmit: false,
            responseType: 'json',
            onChange: function(file, extension) {
                this.setData({'directory': '{$this->directory}'});			
                this.submit();
            },
            onSubmit: function(file, extension) {
                /*$('#upload').append('<i class="icon-spinner loading" style="padding-left: 5px;" />');*/
            },
            onComplete: function(file, json) {
                if (json.success) {	
                    alert(json.success);
                    $.get('{$this->urlGet}/?image=data/{$this->directory}/' + file, null, function(url){
                        $('{$this->thumb}').attr('src', url);
                        $('#{$fieldId}').attr('value', 'data/{$this->directory}/' + file);
                    });
                }
			
                if (json.error) {
                    alert(json.error);
                }
			
                /*$('.loading').remove();*/
            }
        });
EOP;
            
        $cs->registerScript('Yii.' . get_class($this) . '#' . $id, $js, CClientScript::POS_READY);

        echo $html;
    }

}

?>
