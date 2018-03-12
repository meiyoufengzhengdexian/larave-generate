@extends('layouts.admin')

@section('content')
<div class="row" id="app">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                                                                                                                                        <th>name</th>
                                                                                                                <th>account</th>
                                                                                                                <th>password</th>
                                                                                                                <th>yikatong_password</th>
                                                                                                                <th>open_id</th>
                                                                                                                <th>nick_name</th>
                                                                                                                <th>avatar</th>
                                                                                                                <th>sex</th>
                                                                                                                <th>status</th>
                                                                                                                <th>zan</th>
                                                                                                                <th>niming</th>
                                                                                                                <th>id_card</th>
                                                                                                                <th>score_md5</th>
                                                                                                                                                                                                                                        <th>操作</th>
                    </tr>
                    <tr class="item" v-for="(item, key) in list">
                                                                                                                                                                                                                <td>@{{ item.name }}</td>
                                                                                                                                                                                                                        <td>@{{ item.account }}</td>
                                                                                                                                                                                                                        <td>@{{ item.password }}</td>
                                                                                                                                                                                                                        <td>@{{ item.yikatong_password }}</td>
                                                                                                                                                                                                                        <td>@{{ item.open_id }}</td>
                                                                                                                                                                                                                        <td>@{{ item.nick_name }}</td>
                                                                                                                                                                                                                        <td>@{{ item.avatar }}</td>
                                                                                                                                                                                                                        <td>@{{ item.sex }}</td>
                                                                                                                                                                                                                        <td>@{{ item.status }}</td>
                                                                                                                                                                                                                        <td>@{{ item.zan }}</td>
                                                                                                                                                                                                                        <td>@{{ item.niming }}</td>
                                                                                                                                                                                                                        <td>@{{ item.id_card }}</td>
                                                                                                                                                                                                                        <td>@{{ item.score_md5 }}</td>
                                                                                                                                                                                                                                                                        <td>
                            <button class="btn btn-link" @click="edit(item)">编辑</button>
                            |
                            <button class="btn btn-link" @click="del(item)">删除</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <button class="btn btn-danger pull-right" id="generate">Generate</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addcss')
<link rel="stylesheet" href="{{ asset('/plugins/iCheck/all.css') }}">
<style>
    .table-select, .table-input[type=text] {
        /*width:150px;*/
    }
</style>
@endpush
@push('addjs')
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

<script src="{{ asset('/js/vue.js') }}"></script>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            list: @json($list->all()),
            pagination: '{{ $pagination }}'
        }
    });
</script>
@endpush