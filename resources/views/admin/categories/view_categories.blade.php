@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Catagories</a> </div>
        <h1>Categories</h1>
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
              <h5>All Categories</h5>
            </div>
            <div class="widget-content nopadding">
              {{-- <pre>
                @php
                    
                    print_r($categories);
                @endphp
              </pre> --}}
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Parent Category</th>
                    <th>Category Url</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $key=>$category)
                  <tr class="gradeX">
                      <td>{{ $key+1 }}</td>
                      <td>{{ ucfirst($category->name)}}</td>
                      <td>  
                        @if($category->parent_id!=0)
                         {{$category->parent_id}}
                        @else
                        -
                        @endif  
                      </td>
                      <td><a href="{{ $category->url}}">{{ $category->url}}</a></td>
                      <td>@if($category->status==1) Active @else Inactive @endif</td>
                      <td>
                          <a title="Edit Category" href="{{ url('/admin/edit-category/'.$category->id)}}" class="btn btn-primary" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-pencil"></i></a>
                          <a title="Delete Category" rel="{{$category->id}}" rel1="delete-category"  href="javascript:" class="btn btn-danger deleteRecord"  style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-trash"></i></a>
                          
                      </td>
                      
                    </tr>
                      
                  @endforeach
                
              
              </tbody> 
               
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection