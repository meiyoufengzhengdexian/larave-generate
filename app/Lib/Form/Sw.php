<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 14:42
 */

namespace App\Lib\Form;


class Sw extends FormInput
{
    public function __construct($name, $showName, $ext = [], $type = 1)
    {
        parent::__construct($name, $showName, $ext, $type);

        $this->css[] = '<link rel="stylesheet" href="/plugins/iCheck/all.css">';
        $this->js[] = '<script src="/plugins/iCheck/icheck.js"></script>';
        $js = <<<js
<script>
$(function() {
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
})
</script>
js;
        $this->js[] = $js;
    }


    public function view()
    {
        if ($this->type == 1) {
            $html = <<<HTML
        <div class="form-group">
        <label class="control-label" for="{$this->name}">是否{$this->showName}</label>
        <div>
          <div class="checkbox">
              <input type="checkbox" class="minimal" value="1" name="{$this->name}" id="{$this->name}">{$this->showName}
          </div>
        </div>
        </div>
HTML;
        } else {
            $html = <<<HTML
        <div class="form-group">
        <label class="col-sm-2 control-label" for="{$this->name}">是否{$this->showName}</label>
        <div class="col-sm-10">
          <div class="checkbox">
              <input type="checkbox" class="minimal" value="1" name="{$this->name}" id="{$this->name}">{$this->showName}
          </div>
        </div>
        </div>
HTML;
        }

        return $html;
    }
}