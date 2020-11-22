@extends('layouts.admin')
@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          公众号菜单配置
        </h2>
      </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <form class="form-update-mp-menu">
          <div class="card-body">
            <div class="mb-3">
                <div class="form-label">配置Json：</div>
                <textarea class="form-control" name="menu" rows="20" >
{
    "button": [
        {
            "type": "view", 
            "name": "免费发布便民信息", 
            "url": "https://www.zaixixian.com/wx"
        }
    ]
}
                </textarea>
              </div>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-update-mp-menu">修改</button>
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
        $('.btn-update-mp-menu').click(function(event){
            $(event.currentTarget).prop('disabled', true)
            axios.post('/admin/mp/config/menu', $('.form-update-mp-menu').serialize())
            .then(function(response){
                var res = response.data;
                if (res.result) {
                window.location.href = '/admin/mp/config/menu'
                } else {
                toastr.error(res.message)
                $(event.currentTarget).prop('disabled', false)
                }
            })
        })
    })
</script>
@endsection