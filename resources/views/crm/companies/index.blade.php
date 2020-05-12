@extends('layouts.base')

@section('caption', '【公司列表】List of companies')

@section('title', ' 【公司列表】List of companies')

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
            <a href="{{ URL::to('companies/form/create') }}">
                <button type="button" class="btn btn-primary btn active">新增公司</button>
            </a>
            <br><br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i> 公司清單
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example" data-sortable>
                            <thead>
                            <tr>
                                <th class="text-center">名稱</th>
                                <th class="text-center">電話</th>
                                <th class="text-center">所在地</th>
                                <th class="text-center">國家</th>
                                <th class="text-center">員工數</th>
                                <th class="text-center">傳直</th>
                                <th class="text-center">負責人</th>
                                <th class="text-center">狀態</th>
                                <th class="text-center" style="width:200px">動作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $key => $value)
                                <tr class="odd gradeX">

                                    <td class="text-center">{{ $value->name }}</td>
                                    <td class="text-center">{{ $value->phone }}</td>
                                    <td class="text-center">{{ $value->city }}</td>
                                    <td class="text-center">{{ $value->country }}</td>
                                    <td class="text-center">{{ $value->employees_size }}</td>
                                    <td class="text-center">{{ $value->tax_number }}</td>
                                    <td class="text-center">
                                        <a href="{{ URL::to('clients/view/' . $value->client->id) }}">{{ $value->client->full_name }}</a>
                                    </td>
                                    <td class="text-center">
                                            @if($value->is_active == TRUE)
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           onchange='window.location.assign("{{ URL::to('companies/set-active/' . $value->id . '/0') }}")' checked>
                                                    <span class="slider"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           onchange='window.location.assign("{{ URL::to('companies/set-active/' . $value->id . '/1') }}")'>
                                                    <span class="slider"></span>
                                                </label>
                                            @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a class="btn btn-small btn-primary"
                                               href="{{ URL::to('companies/view/' . $value->id) }}">更多資訊</a>
                                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ URL::to('companies/form/update/' . $value->id) }}">修改</a></li>
                                                <!--<li class="divider"></li>
                                                <li><a href="#">Some option</a></li>-->
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $companiesPaginate->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
