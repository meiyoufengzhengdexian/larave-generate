<?= "<?php\n" ?>
namespace App\Modal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\Pinyin\Pinyin;

class <?= ucfirst($request->model_name)?> extends Model
{
    protected $table = '<?= $request->model_name ?>';
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
<?php
    $fields = $request->input('fields', []);
    foreach($fields as $key=>$field){
        if($field['ref'] && !$field['ref_function']){
            $fields[$key]['ref_function'] = 'get'.ucfirst($field['ref_class']);
        }
    }
?>
<?php foreach ($fields as $field): ?>
    <?php if ($field['ref'] =='belongsTo'): ?>
        public function <?=$field['ref_function']?>()
        {
            return $this->belongsTo(<?=$field['ref_class']?>::class, '<?=$field['name']?>', '<?=$field['ref_id']?>');
        }
        <?="\n"?>
    <?php endif ?>
<?php endforeach; ?>

<?php foreach ($fields as $field): ?>
    <?php if ($field['ref'] =='hasMany'): ?>
        public function <?=$field['ref_function']?>()
        {
            return $this->hasMany(<?=$field['ref_class']?>::class, '<?=$field['name']?>', '<?=$field['ref_id']?>');
        }
        <?="\n"?>
    <?php endif ?>
<?php endforeach; ?>

<?php foreach ($fields as $field): ?>
    <?php if ($field['ref'] =='belongsToMany'): ?>
        public function <?=$field['ref_function']?>()
        {
        return $this->belongsToMany(<?=$field['ref_class']?>::class, '<?=$field['name'].'_'.snake_case($field['ref_class'])?>', '<?=$field['name']?>', '<?=$field['ref_id']?>');
        }
        <?="\n"?>
    <?php endif ?>
<?php endforeach; ?>
}
