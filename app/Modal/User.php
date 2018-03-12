<?php
namespace App\Modal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\Pinyin\Pinyin;

class User extends Model
{
    protected $table = 'User';
    protected $guarded  = [];
    protected $dates = ['deleted_at'] ;
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
