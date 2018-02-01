@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">数据库</h3>
                </div>
                <!-- /.box-header -->
                <form class="form-horizontal" action="{{ url('code/database') }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">表名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="" name="table"
                                       placeholder="table name">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">确定</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addcss')

@endpush
@push('addjs')
<script>

</script>
@endpush