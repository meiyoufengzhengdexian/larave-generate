<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 14:41
 */

namespace App\Lib\Form;


abstract class FormInput
{
    public $name;
    public $showName;
    public $css = [];
    public $js = [];
    public $type;
    public function __construct($name, $showName, $ext, $type=1)
    {
        $this->name = $name;
        $this->showName = $showName;
        $this->ext = $ext;
        $this->type = $type;
    }
    abstract public function view();
}