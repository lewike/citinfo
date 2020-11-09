@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
            相亲会员
        </h2>
      </div>
      <div class="col-auto ml-auto d-print-none">
        <a href="{{route('admin.wed.member.create')}}" class="btn btn-primary btn-sm ml-3 d-none d-sm-inline-block">
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
              <th>编号</th>
              <th>姓名</th>
              <th>性别</th>
              <th>年龄</th>
              <th>会员</th>
              <th>注册时间</th>
              <th>择偶标准</th>
              <th>备注</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>未分类</td>
              <td>测试</td>
              <td>18790129933</td>
              <td>255.255.255.255</td>
              <td>2020-10-01</td>
              <td>否</td>
              <td>待审核</td>
              <td>置顶 删除 编辑</td>
            </tr>
            <tr>
              <td>1</td>
              <td>未分类</td>
              <td>测试</td>
              <td>18790129933</td>
              <td>255.255.255.255</td>
              <td>2020-10-01</td>
              <td>否</td>
              <td>待审核</td>
              <td>置顶 删除 编辑</td>
            </tr>
            <tr>
              <td>1</td>
              <td>未分类</td>
              <td>测试</td>
              <td>18790129933</td>
              <td>255.255.255.255</td>
              <td>2020-10-01</td>
              <td>否</td>
              <td>待审核</td>
              <td>
                <a href="#" class="mr-2"><i class="fas fa-fw fa-thumbtack" data-fa-transform="rotate-30"></i>置顶</a>
                <a href="#" class="mr-2"><i class="far fa-fw fa-edit"></i>编辑</a>
                <a href="#" class="text-danger mr-2"><i class="far fa-fw fa-trash-alt"></i>删除</a>
             </tr>
            <tr>
              <td>1</td>
              <td>未分类</td>
              <td>测试</td>
              <td>18790129933</td>
              <td>255.255.255.255</td>
              <td>2020-10-01</td>
              <td>否</td>
              <td>待审核</td>
              <td>置顶 删除 编辑</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection