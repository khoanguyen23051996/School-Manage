@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">My Time Table</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">My Time Table</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    {{ $getClass->class_name }} - {{ $getSubject->subject_name }}
                </h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Week</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Room Number</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getRecord as $valueWeek )
                        <tr>
                            <td>{{ $valueWeek['week_name'] }}</td>
                            <td>{{ !empty($valueWeek['start_time']) ? date('h:i:A', strtotime($valueWeek['start_time'])) : '' }}</td>
                            <td>{{ !empty($valueWeek['end_time']) ? date('h:i:A', strtotime($valueWeek['end_time'])) : '' }}</td>
                            <td>{{ $valueWeek['room_number'] }}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table> 
                <div class="card-footer">
                  <a href="{{ route('teacher.my_class_subject') }}" class="btn btn-default">Back</a>
                </div>
              </div>      
            </div>
          </div>
        </div>
      </div>
    </section> 
  
</div>

@endsection



    


