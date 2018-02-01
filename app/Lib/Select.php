<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 15:33
 */

namespace App\Lib;


class Select extends FormInput
{
    public $css = [];
    public $js = [];
    public $ext = [];
    public function __construct($name, $showName, $ext)
    {
        parent::__construct($name, $showName);
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
    public function view()
    {
        $html = <<<HTML
              <div class="form-group">
                <label>{$this->showName}</label>
                <select class="form-control select2" name="{$this->name}" id="{$this->name}" style="width: 100%;">
                  <option selected="selected">请选择</option>
                  @foreach(\${$this->ext['refModal']}s as \$item)
                  <option selected="selected" value="{{ \$item->id }}">{{ \$item->name}}</option>
                  @endforeach 
                </select>
              </div>
HTML;
        return $html;
    }
}