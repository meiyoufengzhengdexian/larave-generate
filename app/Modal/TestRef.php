<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\Pinyin\Pinyin;

class TestRef extends Model
{
    protected $table = 'test_ref';
    protected $guarded  = [];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public static function createSearKey($data)
    {
        $p = new Pinyin();
        $key = '';
        $key = implode('', $data);
        $key .= implode('', $p->convert($key));
        return $key;
    }

}
