@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Change Password</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
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
            <h3 class="card-title">Change Password</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          
          <form method="POST" action="{{ route('admin.change_password.store') }}">
            @csrf
            @include('auth._message')
            <div class="card-body">
              <div class="form-group">
                <label>Old Password <span style="color: red">*</span></label>
                <input type="password" class="form-control" name="old_password" value="" required placeholder="Old Password">
              </div>
              <div class="form-group">
                <label>New Password <span style="color: red">*</span></label>
                <input type="password" class="form-control" name="new_password" value="" required placeholder="New Password">
              </div>
              
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Change</button>
            </div>
          </form>
        </div>
    </div>  
  </section>
</div>

@endsection