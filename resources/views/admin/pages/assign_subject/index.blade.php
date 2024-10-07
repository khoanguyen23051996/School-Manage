@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Assign Subject</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Assign Subject</li>
          </ol>
        </div><!-- /.col -->
        <div class="col-sm-12" style="text-align: right">
          <a href="{{ route('admin.assign_subject.create') }}" class="btn btn-primary">Add Assign Subject</a>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="car">
    <form action="" method="GET">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3" >
                    <label for="">Class Name</label>
                    <input type="text" name="class_name" class="form-control" placeholder="Class Name" value="{{ Request::get('class_name') }}">
                </div>
                <div class="form-group col-md-3" >
                    <label for="">Subject Name</label>
                    <input type="text" name="subject_name" class="form-control" placeholder="Subject Name" value="{{ Request::get('subject_name') }}">
                </div>
                <div class="form-group col-md-3" >
                  <label for="">Date</label>
                  <input type="date" name="date" class="form-control" placeholder="Date" value="{{ Request::get('date') }}">
                </div>
                <div class="form-group col-md-2" >
                    <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                    <a href="{{ route('admin.assign_subject') }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
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
              <h3 class="card-title">Assign Subject list</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Class Name</th>
                    <th>Subject Name</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($getRecord as $value )
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->class_name }}</td>
                    <td>{{ $value->subject_name }}</td>
                    <td>
                        @if ($value->status == 0)
                            Active
                        @else () 
                            Inactive   
                        @endif
                    </td>
                    <td>{{ $value->created_by_name }}</td>
                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                    <td>
                      <a href="{{ url('admin/assign_subject/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                      <a href="{{ url('admin/assign_subject/delete/'.$value->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
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