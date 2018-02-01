<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class Code extends Controller
{
    public function index()
    {
        return view('code.index');
    }

    public function database(Request $request)
    {
        $r = [
            'table'=>'required'
        ];
        $m =[
            'table'=>'数据库未找到'
        ];
        $v = Validator::make($request->all(), $r, $m);
        $v->validate();

        $tableInfo = null;
        $data = [];
        $cols = Schema::getColumnListing($request->table);

        foreach($cols as $col){
            $type = Schema::getColumnType($request->table, $col);
            $tmp = [];
            $tmp['name'] = $col;
            $tmp['type'] = $type;
            $data[] = $tmp;
        }

        return view('code.table', compact('data'));
    }
}
