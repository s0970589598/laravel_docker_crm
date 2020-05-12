@extends('layouts.base')

@section('caption', 'List of clients')

@section('title', 'List of clients')

@section('lyric', '')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message_success'))
                <div class="alert alert-success">
                    <strong>Well done!</strong> {{ session()->get('message_success') }}
                </div>
            @elseif(session()->has('message_danger'))
                <div class="alert alert-danger">
                    <strong>Danger!</strong> {{ session()->get('message_danger') }}
                </div>
            @endif

            <a href="{{ URL::to('clients/form/create') }}">
                <button type="button" class="btn btn-primary btn active">Add client</button>
            </a>
            <br><br>
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
                <br>
                <div class="float-right">
                    <form action="{{url('clients/export')}}" enctype="multipart/form-data">
                        <button class="btn btn-warning" type="submit">Export</button>
                    </form>
                </div>
                <br><br>
            </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users" aria-hidden="true"></i> List of clients
                    </div>
                    <div class="panel-body" style="overflow:scroll">
                        <div class="table">
                            <table class="table table-responsive table-striped table-bordered table-hover" id="dataTables-example" data-sortable>
                                <thead>
                                <tr>
                                    <th class="text-center">姓名</th>
                                    <th class="text-center">電話</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">生日</th>
                                    <th class="text-center">最後消費時間</th>
                                    <th class="text-center">等級</th>
                                    <th class="text-center">狀態</th>
                                    <th class="text-center" style="width:200px">動作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $key => $value)
                                    <tr class="odd gradeX">
                                        <td class="text-center">{{ $value->full_name }}</td>
                                        <td class="text-center">{{ $value->phone }}</td>
                                        <td class="text-center">{{ $value->email }}</td>
                                        <td class="text-center">{{ $value->birthday }}</td>
                                        <td class="text-center">{{ $value->last_shopping_time }}</td>
                                        <td class="text-center">{{ $value->level }}</td>
                                        <td class="text-center">
                                            @if($value->is_active == TRUE)
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           onchange='window.location.assign("{{ URL::to('clients/set-active/' . $value->id . '/0') }}")' checked>
                                                    <span class="slider"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           onchange='window.location.assign("{{ URL::to('clients/set-active/' . $value->id . '/1') }}")'>
                                                    <span class="slider"></span>
                                                </label>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a class="btn btn-small btn-primary"
                                                   href="{{ URL::to('clients/view/' . $value->id) }}">更多資訊</a>
                                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ URL::to('clients/form/update/' . $value->id) }}">修改</a></li>
                                                    <!--<li class="divider"></li>
                                                    <li><a href="#">回最上面</a></li>-->
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $clientsPaginate->render() !!}
                    </div>
                </div>
        </div>
    </div>
@endsection
