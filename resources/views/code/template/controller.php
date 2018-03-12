<?= "<?php\n" ?>
namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Modal\<?= $request->model_name ?>;
<?php
$fields = $request->fields;
?>
<?php foreach ($fields as $key => $field): ?>
    <?php if ($field['ref']): ?>
        use App\Modal\<?= $field['ref_class'] ?>;
    <?php endif; ?>
<?php endforeach; ?>

<?php
$fields = $request->input('fields', []);
$ref_fields = [];
foreach ($fields as $key => $field) {
    if ($field['ref']) {
        if (!$field['ref_function']) {
            $fields[$key]['ref_function'] = 'get' . ucfirst($field['ref_class']);
        }
        $ref_fields[] = $fields[$key];
    }
}
?>

class <?= $request['controller_name'] ?> extends Controller
{
public function index(Request $request)
{
<?php foreach ($fields as $field): ?>
    <?php if ($field['search'] == 1): ?>
        <?php if ($field['input'] != 'Datetime'): ?>
            $<?= $field['name'] ?> = $request->input('<?= $field['name'] ?>', false);
        <?php else: ?>
            $start<?= ucfirst(camel_case($field['name'])) ?> = $request->input('start<?= ucfirst(camel_case($field['name'])) ?>', false);
            $end<?= ucfirst(camel_case($field['name'])) ?> = $request->input('end<?= ucfirst(camel_case($field['name'])) ?>', false);
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>

$<?= $request['table'] ?> = <?= $request['model_name'] ?>::OrderBy('id', 'desc');
<?php foreach ($fields as $field): ?>
    <?php if ($field['search'] == 1): ?>
        <?php if ($field['input'] != 'Datetime' && $field['input'] != "Date" && $field['input'] != "Time"): ?>
            $<?= $field['name'] ?> && $<?= $request['table'] ?> = $<?= $request['table'] ?>->where('<?= $field['name'] ?>', $<?= $field['name'] ?>);
        <?php elseif ($field['input'] == 'Datetime'): ?>
            $start<?= ucfirst(camel_case($field['name'])) ?> && $<?= $request['table'] ?> = $<?= $request['table'] ?>->whereRaw("DATE_FORMAT(`<?= $field['name'] ?>`, '%Y-%m-%d') >= ?", [$start<?= ucfirst(camel_case($field['name'])) ?>]);
            $end<?= ucfirst(camel_case($field['name'])) ?> && $<?= $request['table'] ?> = $<?= $request['table'] ?>->whereRaw("DATE_FORMAT(`<?= $field['name'] ?>`, '%Y-%m-%d') <= ?", [$end<?= ucfirst(camel_case($field['name'])) ?>]);
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>

<?php if (!empty($ref_fields)) {
    $str = "\$" . $request['table'];
    foreach ($ref_fields as $ref_field) {
        $str .= '->with("' . $ref_field['ref_function'] . '")';
    }
    $str .= ";\n";
} else {
    $str = '';
} ?>
<?= $str ?>
<?php
$var = [];
foreach ($ref_fields as $ref_field) {
    echo strtolower('$' . $ref_field['ref_class']) . 'List = ' . $ref_field['ref_class'] . "::all();\r\n";
    $var[] = '\'' . snake_case(strtolower($ref_field['ref_class'])) . 'List\'';
}

?>
$list = $<?= $request['table'] ?>->paginate(50);
$page = $list->appends($_GET);
$pagination = $page->links()->__toString();

if($request->ajax()) {

return [
'result'=>new Result(Result::$SUCCESS),
'list' =>$list,
'pagination'=>$pagination
];
} else {
return view('admin.<?= $request['view_name'] ?>.index', compact('list', 'pagination',<?= implode(',', $var) ?> ,'request'));
}

}


public function create(Request $request)
{
<?php
$var = [];
foreach ($ref_fields as $ref_field) {
    echo strtolower('$' . $ref_field['ref_class']) . 'List = ' . $ref_field['ref_class'] . "::all();\r\n";
    $var[] = '\'' . snake_case(strtolower($ref_field['ref_class'])) . 'List\'';
}
?>
return view('admin/<?= $request['view_name'] ?>/create', compact('request', <?= implode(',', $var) ?>));
}


public function store(Request $request)
{
$r = [
<?php foreach ($fields as $field): ?>
    <?php if ($field['create'] == 1 && $field['input'] != 'Sw'): ?>
        '<?= $field['name'] ?>'=>'required',
    <?php endif; ?>
<?php endforeach; ?>
];
$m = [
<?php foreach ($fields as $field): ?>
    <?php if ($field['create'] == 1 && $field['input'] != 'Sw'): ?>
        '<?= $field['name'] ?>.required'=>'<?= $field['as'] ?>不能为空',
    <?php endif; ?>
<?php endforeach; ?>
];
$v = Validator::make($request->all(), $r, $m);

$v->validate();

$<?= $request->view_name ?> = new <?= $request->model_name ?>();
<?php foreach ($fields as $field): ?>
    <?php if ($field['create'] == 1): ?>
        <?php if ($field['input'] == 'Sw'): ?>
            $<?= $request->view_name ?>-><?= $field['name'] ?> = $request->input('<?= $field['name'] ?>') ? $request->input('<?=$field['name']?>') : 0;
        <?php else: ?>
            $<?= $request->view_name ?>-><?= $field['name'] ?> = $request->input('<?= $field['name'] ?>');
        <?php endif; ?>
    <?php endif ?>
<?php endforeach; ?>
$<?= $request->view_name ?>->search_key = <?= $request->model_name ?>::createSearKey($request->all());
$<?= $request->view_name ?>->save();
if ($request->ajax()) {
return [
'result' => new Result(true),
'<?= $request->view_name ?>' => $<?= $request->view_name ?>,
];
}else{
return view('admin.success');
}
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