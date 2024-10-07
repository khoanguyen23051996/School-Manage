@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notice Board</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Notice Board</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
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
                      <a href="{{ route('teacher.notice_board') }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
                  </div>
              </div>
          </div>
      </form>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

        @foreach ($getRecord as $value )
        <div class="col-md-12">
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="mailbox-read-info">
                  <h5>{{ $value->title }}</h5>
                  <h6><span class="mailbox-read-time float-right" style="font-weight: bold; color:aliceblue; font-size:16px">{{ date('d-m-Y', strtotime($value->notice_date)) }}</span></h6>
                </div>
                <div class="mailbox-read-message">
                  {{!! $value->message !!}}
                </div>
                <!-- /.mailbox-read-message -->
              </div>
            </div>
        </div>    
        @endforeach
        <div>
          <div style="padding: 10px; float:right">{!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}</div>
        </div>
      </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

@endsection