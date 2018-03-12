<?php
$fields = $request->input('fields', []);
$search = [];
$css = [];
$js = [];
$html = [];
foreach ($fields as $key => $field) {
    if ($field['ref'] && !$field['ref_function']) {
        $fields[$key]['ref_function'] = 'get' . ucfirst($field['ref_class']);
    }
    if($field['create']){
        $classStr = '\\App\Lib\\Form\\';
        $classStr .= $field['input'];
        $inputObj = new $classStr($field['name'], $field['as'], $field, 2);
        $needCss = $inputObj->css;
        $needJs  = $inputObj->js;
        $css = array_merge($css, $needCss);
        $js = array_merge($js, $needJs);
        $html[] = $inputObj->view();
    }
}
$css = array_unique($css);
$js = array_unique($js);
?>
@extends('layouts.admin')

@section('content')
<div class="row" id="app" v-cloak>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $request->model_name ?></h3>
            </div>
            <div class="box-body">
                <form action="/admin/<?=$request->view_name?>" class="form-horizontal" id="saveForm">
                    <?=implode("\r\n", $html)?>
                </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="pull-right">
                    <button class="btn btn-primary" @click="save">保存</button>
                    <button class="btn btn-info" @click="cancel">取消</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addcss')
<?=implode("\r\n", $css)?>
@endpush
@push('addjs')
<?=implode("\r\n", $js)?>

<script src="{{ asset('/js/vue.js') }}"></script>
<script>
    var vm = new Vue({
        el: '#app',
        data: {

        },
        methods: {
            save: function () {
                var data = $('#saveForm').serializeArray();
                var url = $('#saveForm').attr('action');
                $.postData(url,data, function (res) {
                    if(res.result.code == 1){
                        window.href='/admin/success';
                    }else{
                        $.alert(res.result.message || '操作失败');
                    }
                })
            },
            cancel: function () {
                
            }
        }
    });
</script>
@endpush