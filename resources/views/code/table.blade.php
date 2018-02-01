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
                        <tbody>
                        <tr>
                            <th>字段</th>
                            <th>类型</th>
                            <th>输入</th>
                            <th>列表</th>
                            <th>创建</th>
                            <th>编辑</th>
                            <th>关联模型</th>
                            <th>关联显示名</th>
                            <th>关联字段</th>
                        </tr>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['type'] }}</td>
                                <td>
                                    <select name="" id="" class="form-control table-select">
                                        <option value="">
                                            单行文本
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <label><input type="checkbox"
                                                  class="minimal"
                                                  @if($item['name'] != 'id' && $item['name']!='created_at' && $item['name']!='updated_at' && $item['name']!='deleted_at')
                                                  checked
                                                @endif
                                        ></label>
                                </td>
                                <td>
                                    <label><input type="checkbox"
                                                  class="minimal"
                                                  @if($item['name'] != 'id' && $item['name']!='created_at' && $item['name']!='updated_at' && $item['name']!='deleted_at')
                                                  checked
                                                @endif
                                        ></label>
                                </td>
                                <td>
                                    <label><input type="checkbox"
                                                  class="minimal"
                                                  @if($item['name'] != 'id' && $item['name']!='created_at' && $item['name']!='updated_at' && $item['name']!='deleted_at')
                                                  checked
                                                @endif
                                        ></label>
                                </td>
                                <td><input type="text" class="form-control table-input"></td>
                                <td><input type="text" class="form-control table-input" value="name"></td>
                                <td><input type="text" class="form-control table-input" value="id"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addcss')
<link rel="stylesheet" href="{{ asset('/plugins/iCheck/all.css') }}">
<style>
    .table-select,.table-input[type=text]{
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
@endpush