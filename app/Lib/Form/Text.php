<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 14:42
 */

namespace App\Lib\Form;


class Text extends FormInput
{
    public function view()
    {
        $html = <<<HTML
        <div class="form-group">
          <label for="{$this->name}" class="col-sm-2 control-label">{$this->showName}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="{$this->name}" name="{$this->name}" placeholder="{$this->showName}">
          </div>
        </div>
HTML;
        return $html;
    }
}