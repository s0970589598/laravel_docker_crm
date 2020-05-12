@extends('layouts.base')

@section('caption', $clientDetails->full_name . trans('views.client.show.caption'))

@section('title', trans('views.client.show.caption') . $clientDetails->full_name)

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-6">
            @if(session()->has('message_success'))
                <div class="alert alert-success">
                    <strong>Well done!</strong> {{ session()->get('message_success') }}
                </div>
            @elseif(session()->has('message_danger'))
                <div class="alert alert-danger">
                    <strong>Danger!</strong> {{ session()->get('message_danger') }}
                </div>
            @endif
            <br/>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">{{trans('views.client.show.caption')}}</a>
                        </li>
                        <li class=""><a href="#profile" data-toggle="tab">{{trans('views.client.show.basic_info_title')}}<span
                                        class="badge badge-warning">{{ $clientDetails->companiesCount }}</span></a>
                        </li>
                        <li class=""><a href="#messages" data-toggle="tab">{{trans('views.client.show.assigned_em_title')}}<span
                                        class="badge badge-warning">{{ $clientDetails->employeesCount }}</span></a>
                        </li>
                        <div class="text-right">
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                {{trans('views.client.show.delete_client')}}
                                <li class="fa fa-trash-o"></li>
                            </button>
                        </div>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home">
                            <table class="table table-striped table-bordered">
                                <tbody class="text-right">
                                <tr>
                                    <th>姓名</th>
                                    <td>{{ $clientDetails->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>電話</th>
                                    <td>{{ $clientDetails->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $clientDetails->email }}</td>
                                </tr>
                                <tr>
                                    <th>部門</th>
                                    <td>{{ $clientDetails->section }}</td>
                                </tr>
                                <tr>
                                    <th>預算</th>
                                    <td>
                                        <button type="submit"
                                                class="btn btn-default">{{ $clientDetails->formattedBudget }}</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>地址</th>
                                    <td>{{ $clientDetails->location }}</td>
                                </tr>
                                <tr>
                                    <th>郵遞區號</th>
                                    <td>{{ $clientDetails->zip }}</td>
                                </tr>
                                <tr>
                                    <th>縣市</th>
                                    <td>{{ $clientDetails->city }}</td>
                                </tr>
                                <tr>
                                    <th>國家</th>
                                    <td>{{ $clientDetails->country }}</td>
                                </tr>
                                <tr>
                                    <th>生日</th>
                                    <td>{{ $clientDetails->birthday }}</td>
                                </tr>
                                <tr>
                                    <th>消費累積</th>
                                    <td>{{ $clientDetails->cumulative_spend_amt }}</td>
                                </tr>
                                <tr>
                                    <th>最後消費時間</th>
                                    <td>{{ $clientDetails->last_shopping_time }}</td>
                                </tr>
                                <tr>
                                    <th>等級</th>
                                    <td>{{ $clientDetails->level }}</td>
                                </tr>
                                <tr>
                                    <th>已收帳金額</th>
                                    <td>{{ $clientDetails->delivered_amt }}</td>
                                </tr>
                                <tr>
                                    <th>退款金額</th>
                                    <td>{{ $clientDetails->refund_amt }}</td>
                                </tr>
                                <tr>
                                    <th>已消費金額</th>
                                    <td>{{ $clientDetails->used_amt }}</td>
                                </tr>
                                <tr>
                                    <th>現有金額</th>
                                    <td>{{ $clientDetails->existing_amt }}</td>
                                </tr>
                                <tr>
                                    <th>會員資格</th>
                                    <td>{{ $clientDetails->membership }}</td>
                                </tr>
                                <tr>
                                    <th>報價訊息</th>
                                    <td>{{ $clientDetails->offer_info }}</td>
                                </tr>
                                <tr>
                                    <th>期間</th>
                                    <td>{{ $clientDetails->period_time }}</td>
                                </tr>
                                <tr>
                                    <th>產生時間</th>
                                    <td>{{ $clientDetails->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>更新時間</th>
                                    <td>{{ $clientDetails->updated_at }}</td>
                                </tr>
                                <tr>
                                    <th>狀態</th>
                                    <td>{{ $clientDetails->is_active ? 'Active' : 'Deactive' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <h4>公司</h4>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example"
                                   data-sortable>
                                <thead>
                                <tr>
                                    <th>名稱</th>
                                    <th>電話</th>
                                    <th>傳真</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                </tr>
                                @foreach($clientDetails->companies as $companies)
                                    <tbody>
                                    <tr class="odd gradeX">
                                        <td>{{ $companies->name }}</td>
                                        <td>{{ $companies->tax_number }}</td>
                                        <td>{{ $companies->phone }}</td>
                                        <td>
                                            {{ Form::open(['url' => 'clients/delete/' . $companies->id,'class' => 'pull-right']) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('刪除附屬公司', ['class' => 'btn btn-danger btn-sm']) }}
                                            {{ Form::close() }}
                                        </td>
                                    @endforeach
                                    </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="messages">
                            <h4>員工</h4>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example"
                                   data-sortable>
                                <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>電話</th>
                                    <th>Email</th>
                                    <th>職位</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                </tr>
                                @foreach($clientDetails->employees as $employees)
                                    <tbody>
                                    <tr class="odd gradeX">
                                        <td>{{ $employees->full_name }}</td>
                                        <td>{{ $employees->phone }}</td>
                                        <td>{{ $employees->email }}</td>
                                        <td>{{ $employees->job }}</td>
                                        <td>
                                            {{ Form::open(['url' => 'employees/delete/' . $employees->id,'class' => 'pull-right']) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('刪除附屬員工', ['class' => 'btn btn-danger btn-sm']) }}
                                            {{ Form::close() }}
                                        </td>
                                    @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">你想刪除這個會員嗎？</h4>
                </div>
                <div class="modal-body">
                    永久刪除此會員
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 15px;">
                        關閉
                    </button>
                    {{ Form::open(['url' => 'clients/delete/' . $clientDetails->id,'class' => 'pull-right']) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('刪除此會員', ['class' => 'btn btn-small btn-danger']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
