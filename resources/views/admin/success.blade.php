@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="well">
                        <p>操作成功 ^_^ <span id="sec"></span>s后关闭页面
                            <button class="btn btn-link" style="padding-top: 10px;" onclick="closeParent()">现在关闭
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addjs')
<script>
    $(function () {
        var sec = 2;
        $('#sec').html(sec);
        setInterval(function () {
            sec--;
            $('#sec').html(sec);
        }, 1000);

        setTimeout(function () {
            closeParent();
        }, 2000);
    });
    function closeParent(){
        if(opener.vm && opener.vm.getData){
            opener.vm.getData();
        }
        window.close();
    }
</script>
@endpush
