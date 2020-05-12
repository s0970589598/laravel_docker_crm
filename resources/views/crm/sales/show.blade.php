@extends('layouts.base')

@section('caption', 'Information about sales')

@section('title', 'Information about sales')

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
                        <li class="active"><a href="#home" data-toggle="tab">Basic information</a>
                        </li>
                        <div class="text-right">
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                Delete this product <li class="fa fa-trash-o"></li>
                            </button>
                        </div>

                    </ul>
                    <div class="tab-pane fade active in" id="home">
                        <h4></h4>
                        <table class="table table-striped table-bordered">
                            <tbody class="text-right">
                            <tr>
                                <th>order_no</th>
                                <td>{{ $sale->order_no }}</td>
                            </tr>
                            <tr>
                                <th>date_of_payment</th>
                                <td>{{ $sale->date_of_payment }}</td>
                            </tr>
                            <tr>
                                <th>pre_order</th>
                                <td>{{ $sale->pre_order }}</td>
                            </tr>
                            <tr>
                                <th>payment_status</th>
                                <td>{{ $sale->payment_status }}</td>
                            </tr>
                            <tr>
                                <th>payment_order_no</th>
                                <td>{{ $sale->payment_order_no }}</td>
                            </tr>
                            <tr>
                                <th>discount</th>
                                <td>{{ $sale->discount }}</td>
                            </tr>
                            <tr>
                                <th>discount_shop_amt</th>
                                <td>{{ $sale->discount_shop_amt }}</td>
                            </tr>
                            <tr>
                                <th>sum_amt</th>
                                <td>{{ $sale->sum_amt }}</td>
                            </tr>
                            <tr>
                                <th>product_name</th>
                                <td>{{ $sale->product_name }}</td>
                            </tr>
                            <tr>
                                <th>quantity</th>
                                <td>{{ $sale->quantity }}</td>
                            </tr>
                            <tr>
                                <th>product_type</th>
                                <td>{{ $sale->product_type }}</td>
                            </tr>
                            <tr>
                                <th>product_id</th>
                                <td>{{ $sale->product_id }}</td>
                            </tr>
                            <tr>
                                <th>utm_source</th>
                                <td>{{ $sale->utm_source }}</td>
                            </tr>
                            <tr>
                                <th>shipping_status</th>
                                <td>{{ $sale->shipping_status }}</td>
                            </tr>
                            <tr>
                                <th>pickup_time</th>
                                <td>{{ $sale->pickup_time }}</td>
                            </tr>
                            <tr>
                                <th>client_level</th>
                                <td>{{ $sale->client_level }}</td>
                            </tr>
                            <tr>
                                <th>client_phone</th>
                                <td>{{ $sale->client_phone }}</td>
                            </tr>
                            <tr>
                                <th>client_email</th>
                                <td>{{ $sale->client_email }}</td>
                            </tr>
                            <tr>
                                <th>client_sex</th>
                                <td>{{ $sale->client_sex }}</td>
                            </tr>
                            <tr>
                                <th>client_birthday</th>
                                <td>{{ $sale->client_birthday }}</td>
                            </tr>
                            <tr>
                                <th>client_id</th>
                                <td>{{ $sale->client_id }}</td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>{{ $sale->quantity }}</td>
                            </tr>
                            <tr>
                                <th>Assigned Product</th>
                                <td>
                                    <a href="{{ URL::to('products/view/' . $sale->products->id) }}">{{ $sale->products->name }}</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $sale->is_active ? 'Yes' : 'No'  }}</td>
                            </tr>
                            </tbody>
                        </table>
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
                    <h4 class="modal-title" id="myModalLabel">You want delete this products?</h4>
                </div>
                <div class="modal-body">
                    Action will delete permanently this products.
                </div>
                <div class="modal-footer">
                    {{ Form::open(['url' => 'sales/delete/' . $sale->id,'class' => 'pull-right']) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this sale', ['class' => 'btn btn-small btn-danger']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
