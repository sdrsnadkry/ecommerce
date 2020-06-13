@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Inquiries</a> </div>
        <h1>Inquiries VUE</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                @if(Session::has('flash_message_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <strong>
                        {!! session('flash_message_error') !!}
                    </strong>
                </div>
                @endif
                @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <strong>
                        {!! session('flash_message_success') !!}
                    </strong>
                </div>
                @endif
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>All Enquiries</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table" id="app">
                           
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Sender Name</th>
                                    <th>Sender Email</th>
                                    <th>Sent Date/Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX" v-for="inquiry in inquiries">
                                    <td>@{{inquiry.id}}</td>
                                    <td>@{{ inquiry.name}}</td>
                                    <td>@{{ inquiry.sender_email}}</td>
                                    <td>@{{ inquiry.created_at}}</td>
                                    <td>
                                        <a title="View inquiry Details" href="#myModal@{{ inquiry.id }}" data-toggle="modal" class="btn btn-success" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-eye-open"></i></a>
                                        <a title="Delete inquiry" rel="@{{inquiry.id}}" rel1="delete-inquiry" href="javascript:" class="btn btn-danger deleteRecord" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                <div id="myModal@{{ inquiry.id }}" class="modal hide">
                                    <div class="modal-header">
                                        <div class="widget-box">
                                            <div class="widget-title"> <span class="icon"> <i class="icon-eye-open"></i> </span>
                                                <h5 style="font-weight:bold">@{{ inquiry.name}} Inquiry</h5>
                                                <button data-dismiss="modal" class="close " type="button">×</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body" style="padding:0px">
                                        <div class="widget-box">
                                            <div class="widget-content padding">
                                                <p>ID: @{{ inquiry.id }}</p>
                                                <p>Sender Name: @{{ inquiry.name }}</p>
                                                <p>Email: @{{ inquiry.sender_email}}</p>
                                                <p>Subject: @{{ inquiry.subject}}</p>
                                                <p>Inquiry: @{{ inquiry.message}}</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection