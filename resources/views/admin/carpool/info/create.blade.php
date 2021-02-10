@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          添加拼车信息
        </h2>
      </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <form class="form-create-carpool-info">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-2">
                <div class="mb-3">
                  <div class="form-label">拼车类型：</div>
                  <select class="form-select" name="type">
                    <option value="car">车找人</option>
                    <option value="people">人找车</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">出发地：</label>
                  <input type="text" class="form-control" name="direction_from" placeholder="请输入出发地">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">途经地：</label>
                  <input type="text" class="form-control" name="directions" placeholder="请输入途经地">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">目的地：</label>
                  <input type="text" class="form-control" name="direction_to" placeholder="请输入目的地">
                </div>
              </div>
            </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="mb-3">
                  <label class="form-label">出发时间：</label>
                  <input type="datetime-local" class="form-control" name="start_at">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">出发时间说明：</label>
                  <input type="text" class="form-control" name="additional" placeholder="出发时间说明">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">手机号码：</label>
                  <input type="text" class="form-control" name="phone" placeholder="手机号码">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">空位数量：</label>
                  <input type="text" class="form-control" name="seat_cnt" placeholder="剩余空位">
                </div>
              </div>
              
            </div>
            
            <div class="mb-3">
              <label class="form-label">备注：</label>
              <textarea class="form-control" name="description" rows="6"
                style="margin-top: 0px; margin-bottom: 0px; height: 155px;"></textarea>
            </div>
          </div>    
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-create-carpool-info">添加</button>
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
    $('.btn-create-carpool-info').click(function(event){
      $(event.currentTarget).prop('disabled', true)
      axios.post('/admin/carpool/info/create', $('.form-create-carpool-info').serialize())
      .then(function(response){
        var res = response.data;
        if (res.result) {
          window.location.href = '/admin/carpool'
        } else {
          toastr.error(res.message)
          $(event.currentTarget).prop('disabled', false)
        }
      })
    })
})
</script>
@endsection