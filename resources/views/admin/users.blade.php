@extends('layouts.admin')
@section('content')
<section style="margin-top: 70px;" class="accounts">

    <h1 class="heading">Tài khoản người dùng</h1>
    @if (session('msg'))
        <div class="alert alert-{{session('type')}}">
            {{session('msg')}}
        </div>
    @endif
    <div class="box-container">
    @if($listUser)
        @foreach ($listUser as $item)   
            <div class="box">
            <p> ID người dùng : <span>{{$item->id}}</span> </p>
            <p> Tên người dùng : <span>{{$item->username}}</span> </p>
            <a class="btn-user" href="{{route('admin.deleteUser',$item->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
            </div>
        @endforeach
    @endif
    </div>
    <div class="my-5">
        {{$listUser->links()}}
    </div>
</section>
@endsection