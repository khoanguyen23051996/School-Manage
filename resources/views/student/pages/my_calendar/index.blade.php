@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">My Calendar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Calendar</li>
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
            <h3 class="card-title">My Calendar</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div id="calendar"></div>
        </div>
    </div>  
  </section>
</div>

@endsection

@section('script')
<script src='{{ asset('backend/fullcalendar/index.global.js') }}'></script>

<script type="text/javascript"> 
    var events = new Array();

    @foreach ($getMyTimeTable as $value )
        @foreach ($value['week'] as $week )
            events.push({
                title: '{{ $value['name'] }}',
                daysOfWeek: [ {{ $week['fullcalendar_day'] }} ],
                startTime: '{{ $week['start_time'] }}',
                endTime: '{{ $week['end_time'] }}',
            });
        @endforeach    
    @endforeach

    var calendarID = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarID, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        initialDate: '<?=date('Y-m-d')?>',
        navLinks: true,
        editable: false,
        events: events,
        initialView: 'timeGridDay',
    });

    calendar.render();
</script>
@endsection