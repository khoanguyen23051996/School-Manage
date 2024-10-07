@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Class Time Table</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Class Time Table</li>
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
                    <select class="form-control getClass" name="class_id" required>
                        <option value="">--- Select Class ---</option>
                          @foreach ($getClass as $valueClass)
                            <option {{ (Request::get('class_id') == $valueClass->id) ? 'selected' : '' }} value="{{ $valueClass->id }}">{{ $valueClass->class_name }}</option>
                          @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3" >
                    <label for="">Subject Name</label>
                    <select class="form-control getSubject" name="subject_id" required>
                        <option value="">Select</option>
                        @if (!empty($getSubject))
                          @foreach ($getSubject as $valueSubject)
                            <option {{ (Request::get('subject_id') == $valueSubject->subject_id) ? 'selected' : '' }} value="{{ $valueSubject->subject_id }}">{{ $valueSubject->subject_name }}</option>
                          @endforeach 
                        @endif
                    </select>
                </div>
                
                <div class="form-group col-md-2" >
                    <button class="btn btn-primary" type="submit" style="margin-top: 32px">Search</button>
                    <a href="{{ route('admin.class_timetable') }}" class="btn btn-success" style="margin-top: 32px; margin-left: 3px">Reset</a>
                </div>
            </div>
        </div>
    </form>
  </div>

  @include('auth._message')
  @if (!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
  <form action="{{ route('admin.class_timetable.add') }}" method="POST">
    @csrf
    <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
    <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Class Time Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Week</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Room Number</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach ($week as $value)
                      <tr>
                        <th>
                          <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{ $value['week_id'] }}">
                          {{ $value['week_name'] }}
                        </th>
                        <td>
                          <input type="time" name="timetable[{{ $i }}][start_time]" value="{{ $value['start_time'] }}" class="form-control">
                        </td>
                        <td>
                          <input type="time" name="timetable[{{ $i }}][end_time]" value="{{ $value['end_time'] }}" class="form-control">
                        </td>
                        <td>
                          <input type="text" name="timetable[{{ $i }}][room_number]" value="{{ $value['room_number'] }}" class="form-control">
                        </td>
                      </tr>
                      @php
                        $i++;
                      @endphp
                    @endforeach  
                  </tbody>
                </table> 
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section> 
  </form>  
  @endif
</div>
@endsection


@section('script')
<script type="text/javascript">
    $('.getClass').on('change', function(){
        var class_id = $(this).val(); 
        $.ajax({
          url: "{{ url('admin/class_timetable/get_subject') }}",
          type: "POST",
          data:{
              "_token": "{{ csrf_token() }}",
              class_id:class_id,
          },
          dataType:"json",
          success:function(response){
            $('.getSubject').html(response.html);
          },
      });
    });
</script>
@endsection


    


