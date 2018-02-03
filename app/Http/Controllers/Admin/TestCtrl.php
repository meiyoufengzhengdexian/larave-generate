<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class testCtrl extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id', false);
        $text = $request->input('text', false);
        $textarea = $request->input('textarea', false);
        $date_time = $request->input('date_time', false);
        $time = $request->input('time', false);
        $ref_one_of_many = $request->input('ref_one_of_many', false);
        $ref_many_of_many = $request->input('ref_many_of_many', false);

        $test = test::OrderBy('id', 'desc');
        $id && $test = $test->where('id', $id);
        $text && $test = $test->where('text', $text);
        $textarea && $test = $test->where('textarea', $textarea);
        $date_time && $test = $test->where('date_time', $date_time);
        $time && $test = $test->where('time', $time);
        $ref_one_of_many && $test = $test->where('ref_one_of_many', $ref_one_of_many);
        $ref_many_of_many && $test = $test->where('ref_many_of_many', $ref_many_of_many);

        $list = $test->paginate(50);

        if ($request->ajax()) {
            return [
                'result' => new Result(Result::$SUCCESS),
                'list' => $list
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