@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Parent Student ({{ $getParent->name }}) </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Parent</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="car">
    <form action="" method="GET">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3" >
                    <label for="">Student ID</label>
                    <input type="text" name="id" class="form-control" placeholder="Student ID" value="{{ Request::get('id') }}">
                </div>
                <div class="form-group col-md-3" >
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ Request::get('name') }}">
                </div>
                <div class="form-group col-md-3" >
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}" placeholder="Email">
                </div>
                <div class="form-group col-md-3" >
                    <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                    <a href="{{ url('admin/parent/my-student/'.$parent_id) }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
                </div>
            </div>
        </div>
    </form>
  </div>
  @include('auth._message')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">

            @if (!empty($getSearchStudent))
                <div class="card-header">
                    <h3 class="card-title">Student list</h3>
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
                        <th>Parent Name</th>
                        <th>Class</th>
                        <th>Date of birth</th>
                        <th>Created At</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getSearchStudent as $valueStudent )
                        <tr>
                          <td>{{ $valueStudent->id }}</td>
      
                          <td>
                           @if (!empty($valueStudent->getImage()))
                             <img src="{{ $valueStudent->getImage() }}" style="width: 50px; height: 50px; border-radius: 50px">
                           @endif
                          </td>
      
                          <td>{{ $valueStudent->name }}</td>
                          <td>{{ $valueStudent->email }}</td>
                          <td>{{ $valueStudent->parent_name }}</td>
                          <td>{{ $valueStudent->class_name }}</td>
      
                          <td>
                            @if (!empty($valueStudent->date_of_birth))
                              {{ date('d-m-Y', strtotime($valueStudent->date_of_birth)) }}  
                            @endif
                          </td>
                          
                          <td>{{ date('d-m-Y H:i A', strtotime($valueStudent->created_at)) }}</td>
                          <td>
                            <a href="{{ url('admin/parent/assign_student_parent/'.$valueStudent->id.'/'.$parent_id) }}" class="btn btn-primary">Add Student To Parent</a>
                          </td>
                        </tr>   
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->               
            @endif
           
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Parent Student list</h3>
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
                        <th>Parent Name</th>
                        <th>Class</th>
                        <th>Date of birth</th>
                        <th>Created At</th>
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
                          <td>{{ $valueStudent->parent_name }}</td>
                          <td>{{ $valueStudent->class_name }}</td>
      
                          <td>
                            @if (!empty($valueStudent->date_of_birth))
                              {{ date('d-m-Y', strtotime($valueStudent->date_of_birth)) }}  
                            @endif
                          </td>
                          
                          <td>{{ date('d-m-Y H:i A', strtotime($valueStudent->created_at)) }}</td>
                          <td>
                            <a href="{{ url('admin/parent/assign_student_parent_delete/'.$valueStudent->id) }}" class="btn btn-danger">Delete</a>
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