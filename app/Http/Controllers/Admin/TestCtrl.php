<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use App\Modal\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TestCtrl extends Controller
{
    public function index(Request $request)
    {
        $text = $request->input('text', false);
        $startCreateTime = $request->input('start_create_time', false);
        $endCreateTime = $request->input('end_create_time', false);

        $test = Test::OrderBy('id', 'desc');
        $text && $test = $test->where('text', $text);

        $startCreateTime && $test = $test->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$startCreateTime]);
        $endCreateTime && $test = $test->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') <= ?", [$endCreateTime]);

        $list = $test->paginate(5);

        if($request->ajax()) {
            return [
                'result'=>new Result(Result::$SUCCESS),
                'list' =>$list
            ];
        } else {
            return view('admin.test.index', compact('list', 'request'));
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
