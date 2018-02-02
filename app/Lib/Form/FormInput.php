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
    public function __construct($name, $showName)
    {
        $this->name = $name;
        $this->showName = $showName;
    }
    abstract public function view();
}