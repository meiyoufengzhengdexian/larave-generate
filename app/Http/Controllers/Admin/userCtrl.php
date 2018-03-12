<?php
namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Modal\User;
                                                                    

class userCtrl extends Controller
{
public function index(Request $request)
{
                        $id = $request->input('id', false);
                                    $name = $request->input('name', false);
                                    $account = $request->input('account', false);
                                    $password = $request->input('password', false);
                                    $yikatong_password = $request->input('yikatong_password', false);
                                    $open_id = $request->input('open_id', false);
                                    $nick_name = $request->input('nick_name', false);
                                    $avatar = $request->input('avatar', false);
                                    $sex = $request->input('sex', false);
                                    $status = $request->input('status', false);
                                    $zan = $request->input('zan', false);
                                    $niming = $request->input('niming', false);
                                    $id_card = $request->input('id_card', false);
                                    $score_md5 = $request->input('score_md5', false);
                                    $created_at = $request->input('created_at', false);
                                    $updated_at = $request->input('updated_at', false);
                                    $deleted_at = $request->input('deleted_at', false);
            
$user = User::OrderBy('id', 'desc');
                        $id && $user = $user->where('id', $id);
                                    $name && $user = $user->where('name', $name);
                                    $account && $user = $user->where('account', $account);
                                    $password && $user = $user->where('password', $password);
                                    $yikatong_password && $user = $user->where('yikatong_password', $yikatong_password);
                                    $open_id && $user = $user->where('open_id', $open_id);
                                    $nick_name && $user = $user->where('nick_name', $nick_name);
                                    $avatar && $user = $user->where('avatar', $avatar);
                                    $sex && $user = $user->where('sex', $sex);
                                    $status && $user = $user->where('status', $status);
                                    $zan && $user = $user->where('zan', $zan);
                                    $niming && $user = $user->where('niming', $niming);
                                    $id_card && $user = $user->where('id_card', $id_card);
                                    $score_md5 && $user = $user->where('score_md5', $score_md5);
                                    $created_at && $user = $user->where('created_at', $created_at);
                                    $updated_at && $user = $user->where('updated_at', $updated_at);
                                    $deleted_at && $user = $user->where('deleted_at', $deleted_at);
            
$list = $user->paginate(50);
$page = $list->appends($_GET);
$pagination = $page->links()->__toString();

if($request->ajax()) {

return [
'result'=>new Result(Result::$SUCCESS),
'list' =>$list,
'pagination'=>$pagination
];
} else {
return view('admin.user.index', compact('list', 'pagination', 'request'));
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