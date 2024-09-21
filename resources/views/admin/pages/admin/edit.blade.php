@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Admin</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Admin</li>
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
            <h3 class="card-title">Edit Admin</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $getRecord->name }}" required placeholder="Name">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{ $getRecord->email }}" required placeholder="Email">
                <span style="color: red">{{ $errors->first('email') }}</span>
              </div>
              <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Update</button>
                <a href="{{ route('admin.admin') }}" class="btn btn-default">Back</a>
            </div>
          </form>
        </div>
    </div>  
  </section>
</div>

@endsection