<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/3
 * Time: 16:46
 */

namespace App\Lib\Form;


class Datetime extends FormInput
{
    public $startId;
    public $endId;

    public function __construct($name, $showName, $ext=[], $type=1)
    {
        parent::__construct($name, $showName, $ext, $type);
        $this->js[] = '<script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>';
        $this->js[] = '<script src="/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.zh-CN.min.js"></script>';
        $this->css[] = '<link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">';
        $this->startId = 'start'.ucfirst(camel_case($name));
        $this->endId = 'end'.ucfirst(camel_case($name));
        if($type == 1){
            $js = <<<JS
<script>
    $(function(){
        $('#{$this->startId},#{$this->endId}').datepicker({
          autoclose: true,
          language:'zh-CN',
          format:'yyyy-mm-dd'
        })
    });
</script>
JS;
        }else{
            $js = <<<JS
<script>
    $(function(){
        $('#{$this->name}').datepicker({
          autoclose: true,
          language:'zh-CN',
          format:'yyyy-mm-dd'
        })
    });
</script>
JS;
        }

        $this->js[] = $js;
    }

    public function view()
    {
        if($this->type == 1){
            $html = <<<html
<div class="form-group">
          <label for="{$this->startId}" class="control-label">{$this->showName}</label>
          <div>
            <input type="text" class="form-control" id="{$this->startId}" name="{$this->startId}" placeholder="{$this->showName}">
          </div>
        </div>
<div class="form-group">
          <label for="{$this->endId}" class="control-label">{$this->showName}</label>
          <div>
            <input type="text" class="form-control" id="{$this->endId}" name="{$this->endId}" placeholder="{$this->showName}">
          </div>
        </div>
html;
        }else{
            $html = <<<html
<div class="form-group">
          <label for="{$this->name}" class="control-label col-sm-2">{$this->showName}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="{$this->name}" name="{$this->name}" placeholder="{$this->showName}">
          </div>
        </div>
html;
        }

        return $html;
    }

}