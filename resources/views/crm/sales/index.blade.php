@extends('layouts.base')

@section('caption', '【交易】List of sales')

@section('title', '【交易】List of sales')

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
            <a href="{{ URL::to('sales/form/create') }}">
                <button type="button" class="btn btn-primary btn active">Add sales</button>
            </a>
            <br><br>
            <div class="clearfix">
                <div class="float-left">
                    <form class="form-inline" action="{{url('sales/import')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="custom-file">
                                <i class="fa fa-photo "></i>選擇檔案
                                <label class="btn btn-default">
                                    <input class="custom-file-input" id="upload_img" style="" type="file" name="imported_file" >
                                </label>
                            </div>
                        </div>
                        <button style="margin-left: 10px;" class="btn btn-info" type="submit">匯入</button>
                    </form>
                </div>
                <br>
                <div class="float-right">
                    <form action="{{url('sales/export')}}" enctype="multipart/form-data">
                        <button class="btn btn-warning" type="submit">匯出</button>
                    </form>
                </div>
                <br><br>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-keyboard-o" aria-hidden="true"></i> List of sales
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example" data-sortable>
                            <thead>
                            <tr>
                                <th class="text-center">名稱</th>
                                <th class="text-center">數量</th>
                                <th class="text-center">金額</th>
                                <th class="text-center">產品</th>
                                <th class="text-center">交易日期</th>
                                <th class="text-center">狀態</th>
                                <th class="text-center" style="width:200px">動作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales as $key => $value)
                                <tr class="odd gradeX">
                                    <td class="text-center">{{ $value->name }}</td>
                                    <td class="text-center">{{ $value->quantity }}</td>
                                    <td class="text-center">
                                        <button type="submit"class="btn btn-default">
                                            <!--{{ Cknow\Money\Money::{App\Models\SettingsModel::getSettingValue('currency')}
                                            ($value->quantity * $value->products->price) }}-->
                                            {{'$' . ($value->quantity * $value->products->price) }}

                                        </button>
                                    </td>
                                    <td class="text-center"><a
                                                href="{{ URL::to('products/view/' . $value->products->id) }}">{{ $value->products->name }}</a>
                                    </td>
                                    <td class="text-center">{{ $value->date_of_payment }}</td>
                                    <td class="text-center">
                                            @if($value->is_active == TRUE)
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           onchange='window.location.assign("{{ URL::to('sales/set-active/' . $value->id . '/0') }}")' checked>
                                                    <span class="slider"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           onchange='window.location.assign("{{ URL::to('sales/set-active/' . $value->id . '/1') }}")'>
                                                    <span class="slider"></span>
                                                </label>
                                            @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a class="btn btn-small btn-primary"
                                               href="{{ URL::to('sales/view/' . $value->id) }}">更多資訊</a>
                                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ URL::to('sales/form/update/' . $value->id) }}">修改</a></li>
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
                    {!! $salesPaginate->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
