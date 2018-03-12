<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 15:32
 */

namespace App\Lib\Form;


class Number extends FormInput
{
    public function view()
    {
        if($this->type==1){
            $html = <<<HTML
        <div class="form-group">
          <label for="{$this->name}" class="control-label">{$this->showName}</label>
          <div>
            <input type="number" class="form-control" id="{$this->name}" name="{$this->name}" placeholder="{$this->showName}">
          </div>
        </div>
HTML;
        }else{
            $html = <<<HTML
        <div class="form-group">
          <label for="{$this->name}" class="col-sm-2 control-label">{$this->showName}</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="{$this->name}" name="{$this->name}" placeholder="{$this->showName}">
          </div>
        </div>
HTML;
        }

        return $html;
    }
}