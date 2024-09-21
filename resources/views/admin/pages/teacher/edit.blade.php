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
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>First Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $getStudent->name }}" required placeholder="First Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="last_name" value="{{ $getStudent->last_name }}" required placeholder="Last Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Admission Number <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="admission_number" value="{{ $getStudent->admission_number }}" required placeholder="Admission Number">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Role Number <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="roll_number" value="{{ $getStudent->roll_number }}" placeholder="Role Number">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Class <span style="color: red">*</span></label>
                        <select class="form-control" required name="class_id">
                            <option value="">--- Select Class ---</option>
                            @foreach ($getClass as $value_class )
                                <option {{ ($getStudent->class_id == $value_class->id) ? 'selected' : '' }} value="{{ $value_class->id }}">{{ $value_class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Gender <span style="color: red">*</span></label>
                        <select class="form-control" required name="gender">
                            <option value="">--- Select Gender ---</option>
                            <option {{ $getStudent->gender == 'male' ? 'selected' : '' }} value="male">Male</option>
                            <option {{ $getStudent->gender == 'female' ? 'selected' : '' }} value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Date Of Birth <span style="color: red">*</span></label>
                        <input type="date" class="form-control" name="date_of_birth" value="{{ $getStudent->date_of_birth }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Caste <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="caste" value="{{ $getStudent->caste }}" placeholder="Caste">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Mobile Number <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="mobile_number" value="{{ $getStudent->mobile_number }}" required placeholder="Mobile Number">  
                        <span style="color: red">{{ $errors->first('mobile_number') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Admission Date <span style="color: red">*</span></label>
                        <input type="date" class="form-control" name="admission_date" value="{{ $getStudent->admission_date }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image <span style="color: red">*</span></label>
                        <input type="file" class="form-control" name="image">
                        <span style="color: red">{{ $errors->first('image') }}</span>
                        @if (!empty($getStudent->getImage()))
                          <img src="{{ $getStudent->getImage() }}" style="width: auto; height: 50px">
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Status <span style="color: red">*</span></label>
                        <select class="form-control" required name="status">
                            <option value="">--- Select Status ---</option>
                            <option {{ $getStudent->status == 0 ? 'selected' : '' }} value="0">Active</option>
                            <option {{ $getStudent->status == 1 ? 'selected' : '' }} value="1">Inactive</option>
                        </select>
                    </div>
                </div>    
              
                <hr/>

                <div class="form-group">
                    <label>Email <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{ $getStudent->email }}" required placeholder="Email">
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
                <a href="{{ route('admin.student') }}" class="btn btn-default">Back</a>
            </div>
          </form>
        </div>
    </div>  
  </section>
</div>

@endsection