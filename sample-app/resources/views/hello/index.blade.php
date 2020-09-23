@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>{{$msg}}</p>
    @if(count($errors) > 0)
        <p>入力に誤りがあります。正しい値を入力して下さい。</p>
    @endif
    <form action="/hello" method="post">
    <table>
        @csrf
        @error('msg')
            <tr><th>ERROR</th><td>{{$msg}}</td></tr>
        @enderror
        <tr><th>Message: </th><td><input type="text" name="msg" value="{{old('msg')}}"></td></tr>
        <tr><th></th><td><input type="submit" value="send"></td></tr>
    </table>
    </form>
@endsection

@section('footer')
    copyright 2020 nakata.
@endsection
