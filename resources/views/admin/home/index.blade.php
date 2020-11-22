@extends('layouts.admin')

@section('content')
<div class="container-fluid">
     <div class="page-header">
      <div class="row align-items-center">
        <div class="col-auto">
          <h2 class="page-title">
            后台概况
          </h2>
        </div>
      </div>
    </div>
    <div class="row row-deck row-cards">
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">今日发布信息量</div>
            </div>
            <div class="h1 my-3">100条</div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">昨日发布信息量</div>
            </div>
            <div class="h1 my-3">100条</div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">总信息量</div>
            </div>
            <div class="h1 my-3">100条</div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">会员数量</div>
            </div>
            <div class="h1 my-3">100条</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection