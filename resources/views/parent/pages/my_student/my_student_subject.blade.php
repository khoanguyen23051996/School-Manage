@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Student Subject <span style="color: blue">({{ $getUser->name }})</span></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">Student Subject</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  @include('auth._message')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Student Subject</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Subject Name</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($getRecord as $valueSubject )
                  <tr>
                    <td>{{ $valueSubject->id }}</td>
                    <td>{{ $valueSubject->subject_name }}</td>
                    <td>{{ $valueSubject->subject_type }}</td>
                    <td>
                      <a href="{{ url('parent/my_student/subject/class_timetable/'.$valueSubject->class_id.'/'.$valueSubject->subject_id.'/'.$getUser->id) }}" class="btn btn-primary">Time Table</a>
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