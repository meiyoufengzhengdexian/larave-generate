@extends('layouts.admin')

@section('content')
    <div class="row" id="app" v-cloak>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">articel</h3>
                </div>
                <div class="box-body">
                    <form action="/admin/articel" class="form-horizontal" id="saveForm">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" placeholder="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label">content</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="content" name="content"
                                       placeholder="content">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zan" class="col-sm-2 control-label">zan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="zan" name="zan" placeholder="zan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user" class="col-sm-2 control-label">user</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="user" name="user" placeholder="user">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cate" class="col-sm-2 control-label">cate</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="cate" id="cate">
                                    <option>-=请选择=-</option>
                                    @foreach($cateList as $item)
                                        <option selected="selected" value="{{ $item->id }}">{{ $item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="show">是否show</label>
                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <input type="checkbox" class="minimal" value="1" name="show" id="show">show
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="click_count" class="col-sm-2 control-label">click_count</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="click_count" name="click_count"
                                       placeholder="click_count">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="niming">是否niming</label>
                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <input type="checkbox" class="minimal" value="1" name="niming" id="niming">niming
                                </div>
                            </div>
                        </div>
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
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/iCheck/all.css">@endpush
@push('addjs')
    <script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>
        $(function () {
            $('#cate').select2()
        });
    </script>
    <script src="/plugins/iCheck/icheck.js"></script>
    <script>
        $(function () {
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            })
        })
    </script>
    <script src="{{ asset('/js/vue.js') }}"></script>
    <script>
        var vm = new Vue({
            el: '#app',
            data: {},
            methods: {
                save: function () {
                    var data = $('#saveForm').serializeArray();
                    var url = $('#saveForm').attr('action');
                    $.postData(url, data, function (res) {
                        if (res.result.code == 1) {
                            location.href = '/admin/success';
                        } else {
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