@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">My Student</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Student</li>
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
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ Request::get('name') }}">
                </div>
                <div class="form-group col-md-3" >
                    <label for="">Class</label>
                    <input type="text" name="class_name" class="form-control" placeholder="Class" value="{{ Request::get('class_name') }}">
                </div>
                <div class="form-group col-md-3" >
                    <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                    <a href="{{ route('teacher.my_student') }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
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
              <h3 class="card-title">My Student list</h3>
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
                    <th>Mobile</th>
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
                    <td>{{ $valueStudent->mobile_number }}</td>
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