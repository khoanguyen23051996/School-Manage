@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Class</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Class</li>
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
            <h3 class="card-title">Edit Class</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Class Name <span style="color: red">*</span></label>
                <input type="text" class="form-control" name="class_name" value="{{ $getRecord->class_name }}" required placeholder="Class Name">
              </div>
              <div class="form-group">
                <label>Status <span style="color: red">*</span></label>
                <select name="status" class="form-control">
                    <option value="">--- Select Status ---</option>
                    <option {{ $getRecord->status == 0 ? 'selected' : '' }} value="0">Active</option>
                    <option {{ $getRecord->status == 1 ? 'selected' : '' }} value="1">Inactive</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Update</button>
                <a href="{{ route('admin.class') }}" class="btn btn-default">Back</a>
            </div>
          </form>
        </div>
    </div>  
  </section>
</div>

@endsection