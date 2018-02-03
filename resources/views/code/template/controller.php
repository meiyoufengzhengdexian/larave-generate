<?="<?php\n" ?>
namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
<?php
$fields = $request->fields();
?>
<?php foreach ($fields as $key => $field): ?>
    use App\Modal\<?= $field->ref_class ?>;
<?php endforeach; ?>


class <?= $request->controller_name ?> extends Controller
{
public function index(Request $request)
{
<?php foreach ($fields as $field): ?>
    $<?= $field->name ?> = $request->input('<?= $field->name ?>', false);
<?php endforeach; ?>

$<?= $request->table ?> = <?= $request->model_name ?>::OrderBy('id', 'desc');
<?php foreach ($fields as $field): ?>
    <?php if ($field->input != 'DateTime' && $field->input != "Date" && $field->input != "Time"): ?>
        $<?= $field->name ?> && $<?=$request->table ?> = $<?=$request->table ?>->where('<?= $field->name ?>', $<?= $field->name ?>);
    <?php elseif($field->input='DateTime'): ?>
        $start<?=ucfirst(camel_case($field->name))?> && $<?=$request->table?> = $<?=$request->table ?>->whereRaw("DATE_FORMAT(`<?= $field->name ?>`, '%Y-%m-%d') >= ?", [$start<?=ucfirst(camel_case($field->name))?>]);
        $end<?=ucfirst(camel_case($field->name))?> && $<?=$request->table?> = $<?=$request->table ?>->whereRaw("DATE_FORMAT(`<?= $field->name ?>`, '%Y-%m-%d') <= ?", [$end<?=ucfirst(camel_case($field->name))?>]);
    <?php endif; ?>
<?php endforeach; ?>

$list = $<?=$request->table?>->paginate(50);

if($request->ajax()) {
return [
'result'=>new Result(Result::$SUCCESS),
'list' =>$list
];
} else {
return view('admin.<?=$request->view_name?>.index', compact('list', 'request'));
}

}


public function create()
{
//
}


public function store(Request $request)
{
//
}


public function show($id)
{
//
}


public function edit($id)
{
//
}


public function update(Request $request, $id)
{
$r = [
'text'=>'required|max:5'
];
$m = [
'text'=>'请输入正确的textas'
];
$v = Validator::make($request->all(),$r, $m);
}

public function destroy($id)
{
//
}
}

?>