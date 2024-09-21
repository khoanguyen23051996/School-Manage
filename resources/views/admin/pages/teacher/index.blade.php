@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Teacher</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Student</li>
          </ol>
        </div><!-- /.col -->
        <div class="col-sm-12" style="text-align: right">
          <a href="{{ route('admin.teacher.create') }}" class="btn btn-primary">Add Teacher</a>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="car">
    <form action="" method="GET">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-2" >
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ Request::get('name') }}">
                </div>
                <div class="form-group col-md-2" >
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ Request::get('email') }}">
                </div>
                <div class="form-group col-md-2" >
                    <label for="">Date</label>
                    <input type="date" name="date" class="form-control" value="{{ Request::get('date') }}">
                </div>
                <div class="form-group col-md-2" >
                    <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                    <a href="{{ route('admin.teacher') }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Date of Joining</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Qualification</th>
                    <th>Work Experience</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($getRecord as $valueTeacher )
                  <tr>
                    <td>{{ $valueTeacher->id }}</td>

                    <td>
                     @if (!empty($valueTeacher->getImage()))
                       <img src="{{ $valueTeacher->getImage() }}" style="width: 50px; height: 50px; border-radius: 50px">
                     @endif
                    </td>

                    <td>{{ $valueTeacher->name }}</td>
                    <td>{{ $valueTeacher->email }}</td>
                    <td>{{ $valueTeacher->gender }}</td>
                    
                    <td>
                      @if (!empty($valueTeacher->date_of_birth))
                      {{ date('d-m-Y', strtotime($valueTeacher->date_of_birth)) }}  
                      @endif
                    </td>
                    
                    <td>
                      @if (!empty($valueTeacher->date_of_joining))
                        {{ date('d-m-Y', strtotime($valueTeacher->date_of_joining)) }}  
                      @endif
                    </td>

                    <td>{{ $valueTeacher->address }}</td>
                    <td>{{ $valueTeacher->mobile_number }}</td>
                    <td>{{ $valueTeacher->qualification }}</td>
                    <td>{{ $valueTeacher->work_exp }}</td>
                    <td>{{ ($valueTeacher->status == 0) ? 'Active' : 'Inactive' }}</td>
                    <td>{{ date('d-m-Y H:i A', strtotime($valueTeacher->created_at)) }}</td>
                    <td>
                      <a href="{{ url('admin/teacher/edit/'.$valueTeacher->id) }}" class="btn btn-primary">Edit</a>
                      <a href="{{ url('admin/teacher/delete/'.$valueTeacher->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>   
                  @empty
                  <tr>
                      <td colspan="100%">No Record</td>
                  </tr>      
                  @endforelse
                </tbody>
              </table>
              <div style="padding: 10px; float:right">{!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}</div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection