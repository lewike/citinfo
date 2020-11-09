@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          添加分类信息
        </h2>
      </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <form class="form-create-category">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3">
                <div class="mb-3">
                  <div class="form-label">上级分类：</div>
                  <select class="form-select" name="p_id">
                    <option value="0">无</option>
                    @foreach ($categories as $category)
                      <option value="{{$category['m_id']}}">{{$category['name']}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">分类名：</label>
                  <input type="text" class="form-control" name="name" placeholder="">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">分类路径名：</label>
                  <input type="text" class="form-control" name="ename" placeholder="">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">描述：</label>
                  <input type="text" class="form-control" name="desc" placeholder="">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">是否高亮：</label>
                  <select class="form-select" name="highlight">
                    <option value="0">无</option>
                    <option value="1">高亮</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">状态：</label>
                  <select class="form-select" name="status">
                    <option value="normal">正常</option>
                    <option value="hidden">不显示</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">排序：</label>
                  <input type="number" class="form-control" name="weight" value="0">
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-create-category">添加</button>
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
  $('.btn-create-category').click(function(){
     axios.post('/admin/cate/create', $('.form-create-category').serialize())
     .then(function (response) {
         console.log(response);
     })
     .catch(function (error) {
        toastr.error(error);
     })
    })
})
</script>
@endsection