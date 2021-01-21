@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          参数配置        <span class="text-h4">返回</span>
        </h2>
    </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <form class="form-update-wed-config">
        <input type="hidden" name="key" value="wed.notice">
          <div class="card-body">
            <div class="row">
                <div class="form-group">
                  <label for="">公告标题</label>
                  <input type="text" class="form-control" name="title"  placeholder="">
                </div>
                <div class="form-group">
                    <label for="">公告链接</label>
                    <input type="text" class="form-control" name="url"  placeholder="">
                  </div>
            </div>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-update-wed-config">保存配置</button>
            <button type="button" class="btn btn-link">返回</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('extend_js')
<script>
$(function(){
    $('.btn-update-wed-config').on('click', function(event){
        $(event.currentTarget).prop('disabled', true);
        axios.post('/admin/wed/config', $('.form-update-wed-config').serialize())
        .then(function (response) {
            if (response.data.result) {
                toastr.success('已保存');
            }
            $(event.currentTarget).prop('disabled', false)
        })
        .catch(function (error) {
            toastr.error('出错了！');
        })
    });
})
</script>
@endsection