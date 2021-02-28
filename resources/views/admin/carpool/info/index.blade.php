@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
            拼车信息
        </h2>
      </div>
      <div class="col-auto ml-auto d-print-none">
        <a href="/admin/pinche/info/create" class="btn btn-primary btn-sm ml-3 d-none d-sm-inline-block">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="22" height="22" viewBox="0 0 20 20"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z"></path>
            <line x1="11" y1="5" x2="11" y2="17"></line>
            <line x1="5" y1="11" x2="17" y2="11"></line>
          </svg>
          添加
        </a>
      </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <table class="table card-table table-vcenter">
            <thead>
                <tr>
                    <th width="60">编号</th>
                    <th width="70">拼车类型</th>
                    <th width="70">出发地</th>
                    <th width="70">目的地</th>
                    <th width="70">途经地</th>
                    <th width="100">出发时间</th>
                    <th width="100">补充</th>
                    <th width="100">座位/人数</th>
                    <th width="100">车型</th>
                    <th width="100">电话</th>
                    <th width="60">拨打数</th>
                    <th width="80">ip</th>
                    <th width="50">渠道</th>
                    <th width="50">是否置顶</th>
                    <th width="100">发布时间</th>
                    <th width="130">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carpools as $carpool)
                <tr>
                <td>{{$carpool->id}}</td>
                <td>{{$carpool->type()}}</td>
                <td>{{$carpool->direction_from}}</td>
                <td>{{$carpool->direction_to}}</td>
                <td>{{$carpool->directions ?? '-'}}</td>
                <td>{{$carpool->start_at}}</td>
                <td>{{$carpool->additional ?? '-'}}</td>
                <td>{{$carpool->seat_cnt}}</td>
                <td>{{$carpool->car_type ?? '-'}}</td>
                <td>{{$carpool->phone}}</td>
                <td>{{$carpool->call_cnt}}</td>
                <td>{{$carpool->ip ?? '-'}}</td>
                <td>{{$carpool->source}}</td>
                <td>
                    {{$carpool->sticky? '是':'否'}}
                    {{$carpool->sticky_expired_at}}
                </td>
                <td>{{$carpool->created_at}}</td>
                <td><a href="javascript:;" data-id="{{$carpool->id}}" class="btn-carpool-delete-dlg">删除</a> <a href="/admin/pinche/edit/{{$carpool->id}}">修改</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($carpools->hasMorePages())
        <div class="card-footer">
          {{ $carpools->links() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal-delete" tabindex="-1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-title">确定删除？</div>
        <div>如果确定，数据会被永久删除！</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-danger btn-carpool-delete" data-id="" data-bs-dismiss="modal">确定，删除数据</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('extend_js')
<script>
  $(function(){
    $('.btn-carpool-delete-dlg').click(function(event) {

      $('#modal-delete').modal('show');
      var delId = $(event.currentTarget).data('id');
      $('.btn-carpool-delete').attr('data-id', delId);
    });
    $('.btn-carpool-delete').click(function(event){
      $(event.currentTarget).prop('disabled', true)
      axios.post('/admin/pinche/info/delete', {id:$(event.currentTarget).data('id')})
      .then(function(response){
        var res = response.data;
        if (res.result) {
          window.location.href = '/admin/pinche/info'
        } else {
          toastr.error(res.message)
          $(event.currentTarget).prop('disabled', false)
        }
      })
    })
})
</script>
@endsection