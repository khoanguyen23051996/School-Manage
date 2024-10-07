@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Student</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Student</li>
          </ol>
        </div><!-- /.col -->
        <div class="col-sm-12" style="text-align: right">
          <a href="{{ route('admin.student.create') }}" class="btn btn-primary">Add Student</a>
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
                    <label for="">Class</label>
                    <input type="text" name="class_name" class="form-control" placeholder="Class" value="{{ Request::get('class_name') }}">
                </div>
                <div class="form-group col-md-2" >
                    <label for="">Date</label>
                    <input type="date" name="date" class="form-control" value="{{ Request::get('date') }}">
                </div>
                <div class="form-group col-md-2" >
                    <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                    <a href="{{ route('admin.student') }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
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
                    <th>Student Name</th>
                    <th>Parent Name</th>
                    <th>Email</th>
                    <th>Class</th>
                    <th>Gender</th>
                    <th>Date of birth</th>
                    <th>Mobile</th>
                    <th>Status</th>
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
                    <td>{{ $valueStudent->parent_name }}</td>
                    <td>{{ $valueStudent->email }}</td>
                    <td>{{ $valueStudent->class_name }}</td>
                    <td>{{ $valueStudent->gender }}</td>

                    <td>
                      @if (!empty($valueStudent->date_of_birth))
                        {{ date('d-m-Y', strtotime($valueStudent->date_of_birth)) }}  
                      @endif
                    </td>

                    <td>{{ $valueStudent->mobile_number }}</td>
                    <td>{{ ($valueStudent->status == 0) ? 'Active' : 'Inactive' }}</td>
                    <td>{{ date('d-m-Y H:i A', strtotime($valueStudent->created_at)) }}</td>
                    <td style="min-width: 272px">
                      <a href="{{ url('admin/student/edit/'.$valueStudent->id) }}" class="btn btn-primary">Edit</a>
                      <a href="{{ url('admin/student/delete/'.$valueStudent->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                      <a href="{{ url('chat?receiver_id='.base64_encode($valueStudent->id)) }}" class="btn btn-info">Send Message</a>
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