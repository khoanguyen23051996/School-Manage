@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Attendance Student</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Home</a></li>
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
                    <div class="form-group col-md-3" >
                        <label for="">Class Name</label>
                        <select class="form-control" name="class_id" id="getClass" required>
                            <option value="">--- Select Class ---</option>
                            @foreach ($getClass as $class)
                                <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3" >
                        <label for="">Attendance Date</label>
                        <input type="date" class="form-control" id="getAttendanceDate" name="attendance_date" value="{{ Request::get('attendance_date') }}" required>
                    </div>
                    <div class="form-group col-md-2" >
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                        <a href="{{ route('teacher.attendance.student') }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
                    </div>
                </div>
            </div>
        </form>  
        @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Student list</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                @if (!empty($getStudent) && !empty($getStudent->count()))
                @foreach ($getStudent as $value)
                @php
                    $attendance_type = '';
                    $getAttendance = $value->getAttendance($value->id, Request::get('class_id'), Request::get('attendance_date'));

                    if (!empty($getAttendance->attendance_type)) {
                        $attendance_type = $getAttendance->attendance_type;
                    }
                @endphp
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                            <label style="margin-right: 10px">
                                <input type="radio" value="1" {{ ($attendance_type == '1') ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance {{ $value->id }}">Present
                            </label>
                            <label style="margin-right: 10px">
                                <input type="radio" value="2" {{ ($attendance_type == '2') ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance {{ $value->id }}">Late
                            </label>
                            <label style="margin-right: 10px">
                                <input type="radio" value="3" {{ ($attendance_type == '3') ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance {{ $value->id }}">Absent
                            </label>
                            <label style="margin-right: 10px">
                                <input type="radio" value="4" {{ ($attendance_type == '4') ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance {{ $value->id }}">Half Day
                            </label>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
                </table>
            </div>
        </div>
        @endif  
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $('.SaveAttendance').on('change', function(){
        var student_id = $(this).attr('id');
        var attendance_type = $(this).val();
        var class_id = $('#getClass').val();
        var attendance_date = $('#getAttendanceDate').val();

        $.ajax({
            type: "POST",
            url: "{{ url('teacher/attendance/student/save') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                student_id: student_id,
                attendance_type: attendance_type,
                class_id: class_id,
                attendance_date: attendance_date,
            },
            dataType : "Json",
            success: function(data){
                alert(data.message);
            }
        });
    });

</script>
@endsection
        






    


