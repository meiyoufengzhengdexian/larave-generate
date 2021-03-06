<?php

namespace App\Http\Controllers;

use App\Lib\Result;
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
            'table' => 'required'
        ];
        $m = [
            'table' => '数据库未找到'
        ];
        $v = Validator::make($request->all(), $r, $m);
        $v->validate();

        $tableInfo = null;
        $data = [];
        $cols = Schema::getColumnListing($request->table);

        foreach ($cols as $col) {
            $type = Schema::getColumnType($request->table, $col);
            $tmp = [];
            $tmp['name'] = $col;
            $tmp['type'] = $type;
            $data[] = $tmp;
        }

        $dir = '../app/Lib/Form';
        $dirHandele = opendir($dir);
        $className = [];
        while (false !== ($file = readdir($dirHandele))) {
            if ($file == '.' || $file == '..' || is_dir($dir . '/' . $file)) {
                continue;
            }

            if (!strpos($file, '.')) {
                continue;
            }
            if ($file == 'FormInput.php') {
                continue;
            }
            $temp = explode('.', $file);
            $className[] = $temp[0];

        }
        return view('code.table', compact('data', 'className', 'request'));
    }

    public function gen(Request $request)
    {
        $r = [
            'model_name' => 'required',
            'controller_name' => 'required',
            'view_name' => 'required'
        ];
        $m = [
            'model_name'=>'模型名为空',
            'controller_name'=>'控制器名为空',
            'view_name'=>'view名为空',
        ];

        $v = Validator::make($request->all(), $r, $m);
        $v->validate();


        $modelStr = view('code.template.modal', compact('request'))->__toString();
        $controlerStr = view('code.template.controller', compact('request'))->__toString();
        $indexStr = view('code.template.index', compact('request'))->__toString();
        $createStr = view('code.template.create', compact('request'))->__toString();

        if(!is_dir('../app/Modal')){
            mkdir('../app/Modal');
        }
        if(!is_dir('../resources/views/admin/'.$request->view_name)){
            mkdir('../resources/views/admin/'.$request->view_name);
        }

        if(is_file('../app/Modal/'.$request->model_name.'.php') && !$request->input('overwrite', false)){
            return [
                'result' => new Result(2)
            ];
        }else {
            //复写
            file_put_contents('../app/Modal/'.$request->model_name.'.php', $modelStr);
            file_put_contents('../app/Http/Controllers/Admin/'.$request->controller_name.'.php', $controlerStr);

            file_put_contents('../resources/views/admin/'.$request->view_name.'/index.blade.php', $indexStr);
            file_put_contents('../resources/views/admin/'.$request->view_name.'/create.blade.php', $createStr);
        }

        $str = file_get_contents('../routes/web.php');

        if(strpos($str,"Route::resource('{$request->view_name}', '{$request->controller_name}');") === false){
            $str = str_replace('//auto_code_gen_flag', "Route::resource('{$request->view_name}', '{$request->controller_name}');\r\n    //auto_code_gen_flag", $str);
            file_put_contents('../routes/web.php', $str);
        }
        return [
            'result' => new Result(1),
            'data' => $request->all(),
        ];
    }

}
