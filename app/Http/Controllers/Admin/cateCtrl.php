<?php
namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Modal\Cate;
            use App\Modal\Articel;
                        

class cateCtrl extends Controller
{
public function index(Request $request)
{
                            $name = $request->input('name', false);
                                    $show = $request->input('show', false);
                                    $startCreatedAt = $request->input('startCreatedAt', false);
            $endCreatedAt = $request->input('endCreatedAt', false);
                                    $startUpdatedAt = $request->input('startUpdatedAt', false);
            $endUpdatedAt = $request->input('endUpdatedAt', false);
                                    $startDeletedAt = $request->input('startDeletedAt', false);
            $endDeletedAt = $request->input('endDeletedAt', false);
            
$cate = Cate::OrderBy('id', 'desc');
                            $name && $cate = $cate->where('name', $name);
                                    $show && $cate = $cate->where('show', $show);
                                    $startCreatedAt && $cate = $cate->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$startCreatedAt]);
            $endCreatedAt && $cate = $cate->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') <= ?", [$endCreatedAt]);
                                    $startUpdatedAt && $cate = $cate->whereRaw("DATE_FORMAT(`updated_at`, '%Y-%m-%d') >= ?", [$startUpdatedAt]);
            $endUpdatedAt && $cate = $cate->whereRaw("DATE_FORMAT(`updated_at`, '%Y-%m-%d') <= ?", [$endUpdatedAt]);
                                    $startDeletedAt && $cate = $cate->whereRaw("DATE_FORMAT(`deleted_at`, '%Y-%m-%d') >= ?", [$startDeletedAt]);
            $endDeletedAt && $cate = $cate->whereRaw("DATE_FORMAT(`deleted_at`, '%Y-%m-%d') <= ?", [$endDeletedAt]);
            
$list = $cate->paginate(50);

if($request->ajax()) {
return [
'result'=>new Result(Result::$SUCCESS),
'list' =>$list
];
} else {
return view('admin.cate.index', compact('list', 'request'));
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