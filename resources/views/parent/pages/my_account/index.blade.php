@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Student</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Student</li>
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
            <h3 class="card-title">Edit Student</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            @include('auth._message')
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>First Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $getRecord->name }}" required placeholder="First Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="last_name" value="{{ $getRecord->last_name }}" required placeholder="Last Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Mobile Number <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="mobile_number" value="{{ $getRecord->mobile_number }}" required placeholder="Mobile Number">  
                        <span style="color: red">{{ $errors->first('mobile_number') }}</span>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">update</button>
                <a href="{{ route('parent.dashboard') }}" class="btn btn-default">Back</a>
            </div>
          </form>
        </div>
    </div>  
  </section>
</div>

@endsection