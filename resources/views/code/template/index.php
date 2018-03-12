<?php
$fields = $request->input('fields', []);
$search = [];
$css = [];
$js = [];
$searchStrArr = [];
foreach ($fields as $key => $field) {
    if ($field['ref'] && !$field['ref_function']) {
        $fields[$key]['ref_function'] = 'get' . ucfirst($field['ref_class']);
    }

    if($field['search']){
        $search[] = $fields[$key];
        $classStr = '\\App\Lib\\Form\\';
        $classStr .= $field['input'];

        $inputObj = new $classStr($field['name'], $field['as'], $field);

        $needCss = $inputObj->css;
        $needJs  = $inputObj->js;
        $css = array_merge($css, $needCss);
        $js = array_merge($js, $needJs);
        $searchStrArr[] = $inputObj->view();
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
            <div class="box-body">
                <form id="search" class="form-inline" @change="getData(false)" @keyup.enter="getData(false)">
                    <?=implode("\r\n", $searchStrArr)?>
                    <button type="button" class="btn btn-primary" @click="getData(false)">搜索</button>
                    <button type="button" class="btn btn-info" @click="createNew">创建</button>
                </form>
            </div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $request->model_name ?></h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <?php foreach ($fields as $filed): ?>
                            <?php if ($filed['index'] == 1): ?>
                                <th><?= $filed['as'] ?></th>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <th>操作</th>
                    </tr>
                    <tr class="item" v-for="(item, key) in list">
                        <?php foreach ($fields as $field): ?>
                            <?php if ($field['index'] == 1): ?>
                                <?php if (!$field['ref']): ?>
                                    <?= $field['ref'] ?>
                                    <td>@{{ item.<?= $field['name'] ?> }}</td>
                                <?php elseif ($field['ref'] == 'belongsTo'): ?>
                                    <td>@{{ item.<?= strtolower(snake_case($field['ref_function'])) ?> ?
                                        item.<?= strtolower(snake_case($field['ref_function'])) . '.' . $field['ref_name'] ?>
                                        : '空' }}
                                    </td>
                                <?php endif ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
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
<?=implode("\r\n", $css)?>
@endpush
@push('addjs')
<?=implode("\r\n", $js)?>

<script src="{{ asset('/js/vue.js') }}"></script>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            list: @json($list->all()),
            pagination: '{!! str_replace(["\r", "\n", "  "], ["", "", ""], $pagination)  !!}'
        },
        methods: {
            getData: function (url) {
                vthis = this;
                var default_url = '/admin/<?=$request['model_name']?>';
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
                window.open('/admin/<?=$request->view_name?>/create', '_blank')
            }
        }, mounted: function () {
            vthis = this;
            $('body').on('click', '#pagination-group a',function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                vthis.getData(url);
            });
        }
    });
</script>
@endpush