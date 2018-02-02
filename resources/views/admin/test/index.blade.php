@extends('layouts.admin')

@section('content')
    <div class="row" id="test-app">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">搜索</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="text">关键词:</label>
                                    <input type="text" class="form-control" id="text" name="text" placeholder="关键词" value="{{ $request->text }}">
                                </div>
                                <div class="form-group">
                                    <label for="start_create_time">创建开始:</label>
                                    <input type="text" class="form-control" id="start_create_time" name="start_create_time" value="{{ $request->start_create_time }}" placeholder="关键词">
                                </div>
                                <div class="form-group">
                                    <label for="end_create_time">创建结束:</label>
                                    <input type="text" class="form-control" id="end_create_time" name="end_create_time" value="{{ $request->start_create_time }}" placeholder="关键词">
                                </div>
                                <button type="submit" class="btn btn-default">搜索</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">测试</h3>
                </div>
                <div class="box-body"  v-cloak>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>text</th>
                            <th>操作</th>
                        </tr>
                        <tr v-for="(test, testKey) in list">
                            <td>@{{ test.text }}</td>
                            <td>
                                <button class="btn btn-link" type="button" @click="test1">Test</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        {{ $list->appends($_GET)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addcss')
<link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush
@push('addjs')
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<script src="https://cdn.bootcss.com/vue/2.5.13/vue.min.js"></script>
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>
<script>
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })
</script>
<script>
    $(function () {
        $('#start_create_time,#end_create_time').datepicker({
            autoclose:true,
            format: 'yyyy-mm-dd',
            language: 'zh-CN'
        });
    });
</script>
<script>
    $vm = new Vue({
        el: '#test-app',
        data: {
            list:@json($list->all())
        },
        methods: {
            test1: function(){

            },
            test: function () {
                $.getData('/admin/test', {}, function (res) {
                    $.log(res);
                })
            }
        }
    });
</script>

@endpush


