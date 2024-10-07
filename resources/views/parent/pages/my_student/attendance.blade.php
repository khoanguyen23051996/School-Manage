@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Attendance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Attendance</li>
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
                    <div class="form-group col-md-2" >
                        <label for="">Class Name</label>
                        <select class="form-control" name="class_id">
                            <option value="">--- Select Class ---</option>
                            @foreach ($getClass as $class)
                                <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3" >
                        <label for="">Start Attendance Date</label>
                        <input type="date" class="form-control" name="start_attendance_date" value="{{ Request::get('start_attendance_date') }}" >
                    </div>

                    <div class="form-group col-md-3" >
                        <label for="">End Attendance Date</label>
                        <input type="date" class="form-control" name="end_attendance_date" value="{{ Request::get('end_attendance_date') }}" >
                    </div>

                    <div class="form-group col-md-2" >
                        <label for="">Attendance Type</label>
                        <select class="form-control" name="attendance_type">
                            <option value="">--- Select Class ---</option>
                            <option {{ (Request::get('attendance_type') == 1) ? 'selected' : '' }} value="1">Present</option>
                            <option {{ (Request::get('attendance_type') == 2) ? 'selected' : '' }} value="2">Late</option>
                            <option {{ (Request::get('attendance_type') == 3) ? 'selected' : '' }} value="3">Absent</option>
                            <option {{ (Request::get('attendance_type') == 4) ? 'selected' : '' }} value="4">Half Day</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2" >
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                        <a href="{{ url('parent/my_student/attendance/'.$getStudent->id) }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
                    </div>
                </div>
            </div>
        </form>  

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Attendance</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Attendance</th>
                        <th>Attendance Date</th>
                    </tr>
                </thead>
                <tbody>
                  
                    @forelse ($getRecord as $value )
                    <tr>
                        <td>{{ $value->class_name }}</td>
                        <td>
                            @if ($value->attendance_type == 1)
                            Present
                            @elseif ($value->attendance_type == 2) 
                            Late   
                            @elseif ($value->attendance_type == 3) 
                            Absent   
                            @elseif ($value->attendance_type == 4)  
                            Half Day  
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($value->attendance_date)) }}</td>
                    </tr>   
                        @empty
                        <tr>
                            <td colspan="100%">No Record</td>
                        </tr>      
                    @endforelse    

                </tbody>
                </table>

                @if (!empty($getRecord))
                    <div style="padding: 10px; float:right">{!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}</div>  
                @endif
        </div>

    </div>
@endsection

