@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Notice Board</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Communicate</li>
          </ol>
        </div><!-- /.col -->
        <div class="col-sm-12" style="text-align: right">
          <a href="{{ route('admin.communicate.notice_board.create') }}" class="btn btn-primary">Add Notice Board</a>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="car">
    <form action="" method="GET">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3" >
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title" value="{{ Request::get('title') }}">
                </div>
                <div class="form-group col-md-3" >
                    <label for="">Notice Date From</label>
                    <input type="date" name="notice_date_from" class="form-control" value="{{ Request::get('notice_date_from') }}">
                </div>
                <div class="form-group col-md-3" >
                    <label for="">Notice Date To</label>
                    <input type="date" name="notice_date_to" class="form-control" value="{{ Request::get('notice_date_to') }}">
                </div>
                <div class="form-group col-md-2" >
                    <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                    <a href="{{ route('admin.communicate.notice_board') }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
                </div>
            </div>
        </div>
    </form>
  </div>
  @include('auth._message')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Notice Board list</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Notice Date</th>
                    <th>Publish Date</th>
                    <th>Message To</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($getRecord as $value )
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ date('d-m-Y ', strtotime($value->notice_date)) }}</td>
                    <td>{{ date('d-m-Y ', strtotime($value->publish_date)) }}</td>
                    <td>
                      @foreach ($value->getMessage as $message)
                        @if($message->message_to == 2)
                        <div>Teacher</div>
                        @elseif ($message->message_to == 3)
                        <div>Student</div>
                        @elseif ($message->message_to == 4)
                        <div>Parent</div>
                        @endif
                      @endforeach
                    </td>
                    <td>{{ $value->created_by_name }}</td>
                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                    <td>
                      <a href="{{ url('admin/communicate/notice_board/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                      <a href="{{ url('admin/communicate/notice_board/delete/'.$value->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </td>
                  </tr>   
                  @empty
                  <tr>
                      <td colspan="100%">No Record</td>
                  </tr>      
                  @endforelse
                </tbody>
              </table>
              <div style="padding: 10px; float:right">{!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}</div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection