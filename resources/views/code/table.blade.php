@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Table information</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <input type="hidden" name="table" value="{{ $request->table }}">
                        <tbody>
                        <tr>
                            <td style="width:8em;">模型名</td>
                            <td><input type="text" class="form-control" name="model_name"
                                       value="{{ camel_case($request->table) }}"></td>
                        </tr>
                        <tr>
                            <td>控制器名</td>
                            <td><input type="text" class="form-control" name="controller_name"
                                       value="{{ camel_case($request->table).'Ctrl' }}"></td>
                        </tr>
                        <tr>
                            <td>View名</td>
                            <td><input type="text" class="form-control" name="view_name"
                                       value="{{camel_case($request->table)}}"></td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>字段</th>
                            <th>类型</th>
                            <th>别名</th>
                            <th>输入</th>
                            <th>搜索</th>
                            <th>排序</th>
                            <th>列表</th>
                            <th>创建</th>
                            <th>编辑</th>
                            <th>关联关系</th>
                            <th>关联方法名</th>
                            <th>关联模型</th>
                            <th>关联显示名</th>
                            <th>关联字段</th>
                        </tr>
                        @foreach($data as $item)
                            <tr class="item">
                                <input type="hidden" class="name" value="{{ $item['name'] }}">
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['type'] }}</td>
                                <td>
                                    <input type="text" class="form-control table-input as" value="{{ $item['name'] }}">
                                </td>
                                <td>
                                    <select name="" id="" class="form-control table-select input">
                                        @foreach($className as $class)
                                            <option value="{{ $class }}" @if($class == 'Text') selected @endif>
                                                {{ $class }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <label><input type="checkbox"
                                                  class="minimal search"
                                                  checked
                                                  value="1"
                                        ></label>
                                </td>
                                <td>
                                    <label><input type="checkbox"
                                                  class="minimal order"
                                                  checked
                                                  value="1"
                                        ></label>
                                </td>
                                <td>
                                    <label><input type="checkbox"
                                                  class="minimal index"
                                                  @if($item['name'] != 'id' && $item['name']!='created_at' && $item['name']!='updated_at' && $item['name']!='deleted_at')
                                                  checked
                                                  @endif
                                                  value="1"
                                        ></label>
                                </td>
                                <td>
                                    <label><input type="checkbox"
                                                  class="minimal create"
                                                  @if($item['name'] != 'id' && $item['name']!='created_at' && $item['name']!='updated_at' && $item['name']!='deleted_at')
                                                  checked
                                                  @endif
                                                  value="1"
                                        ></label>
                                </td>

                                <td>
                                    <label><input type="checkbox"
                                                  class="minimal edit"
                                                  @if($item['name'] != 'id' && $item['name']!='created_at' && $item['name']!='updated_at' && $item['name']!='deleted_at')
                                                  checked
                                                  @endif
                                                  value="1"
                                        ></label>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control table-select ref">
                                        <option value="">no</option>
                                        <option value="belongsTo">belongsTo</option>
                                        <option value="hasMany">hasMany</option>
                                        <option value="belongsToMany">belongsToMany</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control table-input ref-function" placeholder="默认为get+模型名"></td>
                                <td><input type="text" class="form-control table-input ref-class"></td>
                                <td><input type="text" class="form-control table-input ref-name" value="name"></td>
                                <td><input type="text" class="form-control table-input ref-id" value="id"></td>
                            </tr>
                        @endforeach
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
<script>
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })
</script>
<script>
    $(function () {
        $('#generate').on('click', function () {
            var fieldlist = [];
            $('.item').each(function (k, v) {
                var $v = $(v);
                var field = {};
                field.name = $v.find('.name').val();
                field.as = $v.find('.as').val();
                //select
                field.input = $v.find('.input option:selected').val();

                //checkbox
                field.search = !!$v.find('.search:checked').val()?1:0;
                field.order = !!$v.find('.order:checked').val()?1:0;
                field.index = !!$v.find('.index:checked').val()?1:0;
                field.create = !!$v.find('.create:checked').val()?1:0;
                field.edit = !!$v.find('.edit:checked').val()?1:0;

                field.ref_class = $v.find('.ref-class').val();
                field.ref_id = $v.find('.ref-id').val();
                field.ref_name = $v.find('.ref-name').val();
                field.ref = $v.find('.ref option:selected').val();
                field.ref_function = $v.find('.ref-function').val();
                fieldlist.push(field);
            });

            var data = {
                fields: fieldlist,
                table: $('[name=table]').val(),
                model_name: $('[name=model_name]').val(),
                controller_name: $('[name=controller_name]').val(),
                view_name: $('[name=view_name]').val()
            };

            $.postData('/code/table', data, function (res) {
                switch (res.result.code) {
                    case 1 :
                        $.alert('生成成功');
                        break;
                    case 2:
                        $.confirm('已经生成过！是否覆盖？', function () {
                            data.overwrite = true;
                            $.postData('/code/table', data, function (res) {
                                if (res.result.code == 1) {
                                    $.alert('生成成功');
                                } else {
                                    $.alert(res.result.message || '生成失败');
                                }
                            });
                        });
                        break;
                    case -1:
                        $.alert(res.result.message || '生成失败');
                }
            });
        });
    });
</script>
@endpush