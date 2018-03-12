<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Modal\articel;
use App\Modal\Cate;


class articelCtrl extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id', false);
        $title = $request->input('title', false);
        $content = $request->input('content', false);
        $zan = $request->input('zan', false);
        $user = $request->input('user', false);
        $cate = $request->input('cate', false);
        $show = $request->input('show', false);
        $click_count = $request->input('click_count', false);
        $niming = $request->input('niming', false);
        $startCreatedAt = $request->input('startCreatedAt', false);
        $endCreatedAt = $request->input('endCreatedAt', false);

        $articel = articel::OrderBy('id', 'desc');
        $id && $articel = $articel->where('id', $id);
        $title && $articel = $articel->where('title', $title);
        $content && $articel = $articel->where('content', $content);
        $zan && $articel = $articel->where('zan', $zan);
        $user && $articel = $articel->where('user', $user);
        $cate && $articel = $articel->where('cate', $cate);
        $show && $articel = $articel->where('show', $show);
        $click_count && $articel = $articel->where('click_count', $click_count);
        $niming && $articel = $articel->where('niming', $niming);
        $startCreatedAt && $articel = $articel->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$startCreatedAt]);
        $endCreatedAt && $articel = $articel->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') <= ?", [$endCreatedAt]);

        $articel->with("getCate");
        $cateList = Cate::all();
        $list = $articel->paginate(50);

        $page = $list->appends($_GET);
        $pagination = $page->links()->__toString();

        if ($request->ajax()) {
            return [
                'result' => new Result(Result::$SUCCESS),
                'list' => $list,
                'pagination' => $pagination
            ];
        } else {
            return view('admin.articel.index', compact('list', 'pagination', 'cateList', 'request'));
        }

    }


    public function create(Request $request)
    {
        $cateList = Cate::all();
        return view('admin/articel/create', compact('request', 'cateList'));
    }


    public function store(Request $request)
    {
        $r = [
            'title' => 'required',
            'content' => 'required',
            'zan' => 'required',
            'user' => 'required',
            'cate' => 'required',
            'click_count' => 'required',
        ];
        $m = [
            'title.required' => 'title不能为空',
            'content.required' => 'content不能为空',
            'zan.required' => 'zan不能为空',
            'user.required' => 'user不能为空',
            'cate.required' => 'cate不能为空',
            'click_count.required' => 'click_count不能为空',
        ];
        $v = Validator::make($request->all(), $r, $m);

        $v->validate();

        $articel = new Articel();
        $articel->title = $request->input('title');
        $articel->content = $request->input('content');
        $articel->zan = $request->input('zan');
        $articel->user = $request->input('user');
        $articel->cate = $request->input('cate');
        $articel->show = $request->input('show') ? $request->input('show') : 0;
        $articel->click_count = $request->input('click_count');
        $articel->niming = $request->input('niming') ? $request->input('niming') : 0;
        $articel->search_key = Articel::createSearKey($request->all());
        $articel->save();

        if ($request->ajax()) {
            return [
                'result' => new Result(true),
                'articel' => $articel,
            ];
        } else {
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
            'text' => 'required|max:5'
        ];
        $m = [
            'text' => '请输入正确的textas'
        ];
        $v = Validator::make($request->all(), $r, $m);
    }

    public function destroy($id)
    {
//
    }
}

?>