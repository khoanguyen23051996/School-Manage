@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">My Student </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">My Student</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="car">
  </div>
  @include('auth._message')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">

          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">My Student list</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Date of birth</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($getRecord as $valueStudent )
                        <tr>
                          <td>{{ $valueStudent->id }}</td>
      
                          <td>
                           @if (!empty($valueStudent->getImage()))
                             <img src="{{ $valueStudent->getImage() }}" style="width: 50px; height: 50px; border-radius: 50px">
                           @endif
                          </td>
      
                          <td>{{ $valueStudent->name }}</td>
                          <td>{{ $valueStudent->email }}</td>
                          <td>{{ $valueStudent->class_name }}</td>
      
                          <td>
                            @if (!empty($valueStudent->date_of_birth))
                              {{ date('d-m-Y', strtotime($valueStudent->date_of_birth)) }}  
                            @endif
                          </td>
                          <td>
                            <a href="{{ url('parent/my_student/subject/'.$valueStudent->id) }}" class="btn btn-primary">Subject</a>
                            <a href="{{ url('parent/my_student/calendar/'.$valueStudent->id) }}" class="btn btn-success">Calendar</a>
                            <a href="{{ url('parent/my_student/attendance/'.$valueStudent->id) }}" class="btn btn-warning">Attendance</a>
                          </td>
                        </tr>   
                        @empty
                        <tr>
                            <td colspan="100%">No Record</td>
                        </tr>      
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection