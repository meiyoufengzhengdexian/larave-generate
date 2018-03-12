<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 15:33
 */

namespace App\Lib\Form;


class Select extends FormInput
{
    public $css = [];
    public $js = [];
    public $ext = [];
    public function __construct($name, $showName, $ext=[], $type=1)
    {
        parent::__construct($name, $showName, $ext, $type);
        $this->ext = $ext;
        $this->css[] = '<link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">';
        $this->js[] = '<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>';
        $select2 = <<<SELECT2
<script>
$(function() {
  $('#{$this->name}').select2()
});
</script>
SELECT2;
        $this->js[] = $select2;
    }

    /**
     * ext: ref_class
     * @return string
     */
    public function view()
    {
        $ref_class = camel_case(strtolower($this->ext['ref_class']));
        if($this->type == 1){
            $html = <<<HTML
              <div class="form-group">
                <label for="{$this->name}" class="control-label">{$this->showName}</label>
                <div>
                <select class="form-control select2" name="{$this->name}" id="{$this->name}">
                  <option selected="selected">-=请选择=-</option>
                  @foreach(\${$ref_class}List as \$item)
                  <option value="{{ \$item->id }}">{{ \$item->name}}</option>
                  @endforeach 
                </select>
</div>
              </div>
HTML;
        }else{
            $html = <<<HTML
              <div class="form-group">
                <label for="{$this->name}" class="col-sm-2 control-label">{$this->showName}</label>
                <div class="col-sm-10">
                <select class="form-control select2" name="{$this->name}" id="{$this->name}">
                  <option>-=请选择=-</option>
                  @foreach(\${$ref_class}List as \$item)
                  <option selected="selected" value="{{ \$item->id }}">{{ \$item->name}}</option>
                  @endforeach 
                </select>
</div>
              </div>
HTML;
        }

        return $html;
    }
}