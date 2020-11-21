@extends('layouts.wed')

@section('content')
<div class="wrap">
    <div>
        {{$member['avatar']}}
        {{$member['name']}}
        {{$member['car']}}
        {{$member['age']}}
        {{$member['job']}}
    </div>
</div>
@endsection