@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Teacher</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Teacher</li>
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
            <h3 class="card-title">Edit Teacher</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>First Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $getTeacher->name }}" required placeholder="First Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="last_name" value="{{ $getTeacher->last_name }}" required placeholder="Last Name">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Gender <span style="color: red">*</span></label>
                      <select class="form-control" required name="gender">
                          <option value="">--- Select Gender ---</option>
                          <option {{ $getTeacher->gender == 'male' ? 'selected' : '' }} value="male">Male</option>
                          <option {{ $getTeacher->gender == 'female' ? 'selected' : '' }} value="female">Female</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Date Of Birth <span style="color: red">*</span></label>
                      <input type="date" class="form-control" name="date_of_birth" value="{{ $getTeacher->date_of_birth }}" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mobile Number <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="mobile_number" value="{{ $getTeacher->mobile_number }}" required placeholder="Mobile Number">  
                      <span style="color: red">{{ $errors->first('mobile_number') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Address <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="address" value="{{ $getTeacher->address }}" required placeholder="Address">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Qualification <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="qualification" value="{{ $getTeacher->qualification }}" placeholder="Qualification">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Work Experience <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="work_exp" value="{{ $getTeacher->work_exp }}" placeholder="Work Experience">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Date Of Joining <span style="color: red">*</span></label>
                        <input type="date" class="form-control" name="date_of_joining" value="{{ $getTeacher->date_of_joining }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image <span style="color: red">*</span></label>
                        <input type="file" class="form-control" name="image">
                        <span style="color: red">{{ $errors->first('image') }}</span>
                        @if (!empty($getTeacher->getImage()))
                          <img src="{{ $getTeacher->getImage() }}" style="width: auto; height: 50px">
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Status <span style="color: red">*</span></label>
                        <select class="form-control" required name="status">
                            <option value="">--- Select Status ---</option>
                            <option {{ $getTeacher->status == 0 ? 'selected' : '' }} value="0">Active</option>
                            <option {{ $getTeacher->status == 1 ? 'selected' : '' }} value="1">Inactive</option>
                        </select>
                    </div>
                </div>    
              
                <hr/>

                <div class="form-group">
                    <label>Email <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{ $getTeacher->email }}" required placeholder="Email">
                    <span style="color: red">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group">
                    <label >Password <span style="color: red">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">update</button>
                <a href="{{ route('admin.teacher') }}" class="btn btn-default">Back</a>
            </div>
          </form>
        </div>
    </div>  
  </section>
</div>

@endsection