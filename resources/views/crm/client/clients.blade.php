<?php set_time_limit(0);?>

@extends('layouts.base')

@section('caption', 'List of clients')

@section('title', 'List of clients')

@section('lyric', '')

@section('content')

<div class="container">
    <div class="text-center" style="margin: 20px 0px 20px 0px;">
        <a href="https://www.mynotepaper.com/" target="_blank"><img src="https://i.imgur.com/hHZjfUq.png"></a><br>
        <span class="text-secondary">Laravel 6 Import Export Excel with Heading using Laravel Excel 3.1</span>
    </div>
    <br/>

    <div class="clearfix">
        <div class="float-left">
            <form class="form-inline" action="{{url('clients/import')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="custom-file">
                        <i class="fa fa-photo "></i>選擇檔案
                        <label class="btn btn-default">
                            <input class="custom-file-input" id="upload_img" style="" type="file" name="imported_file" >
                        </label>
                    </div>
                </div>
                <button style="margin-left: 10px;" class="btn btn-info" type="submit">Import</button>
            </form>
        </div>
        <div class="float-right">
            <form action="{{url('clients/export')}}" enctype="multipart/form-data">
                <button class="btn btn-warning" type="submit">Export</button>
            </form>
        </div>
    </div>
    <br/>

    @if(count($clients))
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>姓名</td>
                <td>電話</td>
            </tr>
            </thead>
            @foreach($clients as $client)
                <tr>
                    <td>{{$client->full_name}}</td>
                    <td>{{$client->phone}}</td>
                </tr>
            @endforeach
        </table>
    @endif

</div>
@endsection
