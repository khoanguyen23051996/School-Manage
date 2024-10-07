@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Assign Class Teacher</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Assign Class Teacher</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Assign Class Teacher</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="{{ route('admin.assign_class_teacher.store') }}"> 
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Class Name<span style="color: red">*</span></label>
                <select name="class_id" class="form-control" required>
                  <option value="">--- Select Class ---</option>
                  @foreach ($getClass as $value_class)
                    <option value="{{ $value_class->id }}">{{ $value_class->class_name }}</option>  
                  @endforeach
              </select>
              </div>
              <div class="form-group">
                <label>Teacher Name <span style="color: red">*</span></label>
                @foreach ($getTeacher as $teacher)
                <div>
                  <label style="font-weight: nomal">
                    <input type="checkbox" value="{{ $teacher->id }}" name="teacher_id[]"> {{ $teacher->name }}
                  </label>
                </div> 
                @endforeach
              </div>
              <div class="form-group">
                <label>Status <span style="color: red">*</span></label>
                <select name="status" class="form-control">
                    <option value="">--- Select Status ---</option>
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
                </select>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Add</button>
                <a href="{{ route('admin.assign_subject') }}" class="btn btn-default">Back</a>
            </div>
          </form>
        </div>
    </div>  
  </section>
</div>

@endsection