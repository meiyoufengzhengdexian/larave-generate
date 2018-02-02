<?php
namespace App\Modal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\Pinyin\Pinyin;

class Test extends Model
{
    protected $table = 'Test';
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

    public function getTestRef()
    {
        return $this->belongsTo(TestRef::class, 'ref_one_of_many', 'id');
    }
}
