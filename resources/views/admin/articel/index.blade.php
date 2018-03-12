@extends('layouts.admin')

@section('content')
    <div class="row" id="app" v-cloak>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form id="search" class="form-inline" @change="getData(false)" @keyup.enter="getData(false)">
                        <div class="form-group">
                            <label for="id" class="control-label">id</label>
                            <div>
                                <input type="text" class="form-control" id="id" name="id" placeholder="id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label">title</label>
                            <div>
                                <input type="text" class="form-control" id="title" name="title" placeholder="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="control-label">content</label>
                            <div>
                                <input type="text" class="form-control" id="content" name="content"
                                       placeholder="content">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zan" class="control-label">zan</label>
                            <div>
                                <input type="text" class="form-control" id="zan" name="zan" placeholder="zan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user" class="control-label">user</label>
                            <div>
                                <input type="text" class="form-control" id="user" name="user" placeholder="user">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cate" class="control-label">cate</label>
                            <div>
                                <select class="form-control select2" name="cate" id="cate">
                                    <option selected="selected" value="">-=请选择=-</option>
                                    @foreach($cateList as $item)
                                        <option value="{{ $item->id }}">{{ $item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="show">是否show</label>
                            <div>
                                <div class="checkbox">
                                    <input type="checkbox" class="minimal" value="1" name="show" id="show">show
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="click_count" class="control-label">click_count</label>
                            <div>
                                <input type="number" class="form-control" id="click_count" name="click_count"
                                       placeholder="click_count">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="niming">是否niming</label>
                            <div>
                                <div class="checkbox">
                                    <input type="checkbox" class="minimal" value="1" name="niming" id="niming">niming
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="startCreatedAt" class="control-label">created_at</label>
                            <div>
                                <input type="text" class="form-control" id="startCreatedAt" name="startCreatedAt"
                                       placeholder="created_at">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endCreatedAt" class="control-label">created_at</label>
                            <div>
                                <input type="text" class="form-control" id="endCreatedAt" name="endCreatedAt"
                                       placeholder="created_at">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" @click="getData(false)">搜索</button>
                        <button type="button" class="btn btn-info" @click="createNew">创建</button>
                    </form>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">articel</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>content</th>
                            <th>zan</th>
                            <th>user</th>
                            <th>cate</th>
                            <th>show</th>
                            <th>click_count</th>
                            <th>niming</th>
                            <th>操作</th>
                        </tr>
                        <tr class="item" v-for="(item, key) in list">
                            <td>@{{ item.id }}</td>
                            <td>@{{ item.title }}</td>
                            <td>@{{ item.content }}</td>
                            <td>@{{ item.zan }}</td>
                            <td>@{{ item.user }}</td>
                            <td>@{{ item.get_cate ?
                                item.get_cate.name : '空' }}
                            </td>
                            <td>@{{ item.show }}</td>
                            <td>@{{ item.click_count }}</td>
                            <td>@{{ item.niming }}</td>
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
                    <div class="pull-right">
                        <div class="pull-right" v-html="pagination" id="pagination-group"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addcss')
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">@endpush
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
    <script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.zh-CN.min.js"></script>
    <script>
        $(function () {
            $('#startCreatedAt,#endCreatedAt').datepicker({
                autoclose: true,
                language: 'zh-CN',
                format: 'yyyy-mm-dd'
            })
        });
    </script>
    <script src="{{ asset('/js/vue.js') }}"></script>
    <script>
        window.vm = new Vue({
            el: '#app',
            data: {
                list: @json($list->all()),
                pagination: '{!! str_replace(["\r", "\n", "  "], ["", "", ""], $pagination)  !!}'
            },
            methods: {
                getData: function (url) {
                    vthis = this;
                    var default_url = '/admin/articel';
                    if (url) {
                        default_url = url;
                    }
                    var data = $('#search').serializeArray();
                    $.load();
                    $.getData(default_url, data, function (res) {
                        $.close();
                        if (res.result.code == 1) {
                            vthis.list = res.list.data;
                            vthis.pagination = res.pagination;
                        }
                    })
                },
                createNew: function () {
                    window.open('/admin/articel/create', '_blank')
                }
            }, mounted: function () {
                vthis = this;
                $('body').on('click', '#pagination-group a', function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    vthis.getData(url);
                });
            }
        });
    </script>
@endpush