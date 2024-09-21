@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Subject</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Subject</li>
          </ol>
        </div><!-- /.col -->
        <div class="col-sm-12" style="text-align: right">
          <a href="{{ route('admin.subject.create') }}" class="btn btn-primary">Add Subject</a>
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
                  <label for="">Subject Name</label>
                  <input type="text" name="subject_name" class="form-control" placeholder="Subject" value="{{ Request::get('subject_name') }}">
                </div>
                <div class="form-group col-md-3" >
                  <label>Subject Type</label>
                  <select name="type" class="form-control" >
                    <option value="">--- Select type ---</option>
                    <option {{ (Request::get('type') == 'Theory') ? 'selected' : '' }} value="Theory">Theory</option>
                    <option {{ (Request::get('type') == 'Practical') ? 'selected' : '' }} value="Practical">Practical</option>
                  </select>
                </div>
                <div class="form-group col-md-3" >
                  <label for="">Date</label>
                  <input type="date" name="date" class="form-control" placeholder="Date" value="{{ Request::get('date') }}">
                </div>
                <div class="form-group col-md-2" >
                    <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                    <a href="{{ route('admin.subject') }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
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
              <h3 class="card-title">Subject list</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Subject Name</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($getRecord as $valueSubject )
                  <tr>
                    <td>{{ $valueSubject->id }}</td>
                    <td>{{ $valueSubject->subject_name }}</td>
                    <td>{{ $valueSubject->type }}</td>
                    <td>
                        @if ($valueSubject->status == 0)
                            Active
                        @else () 
                            Inactive   
                        @endif
                    </td>
                    <td>{{ $valueSubject->created_by_name }}</td>
                    <td>{{ date('d-m-Y H:i A', strtotime($valueSubject->created_at)) }}</td>
                    <td>
                      <a href="{{ url('admin/subject/edit/'.$valueSubject->id) }}" class="btn btn-primary">Edit</a>
                      <a href="{{ url('admin/subject/delete/'.$valueSubject->id) }}" class="btn btn-danger">Delete</a>
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