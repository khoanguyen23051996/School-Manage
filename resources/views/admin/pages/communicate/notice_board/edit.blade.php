@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Notice Board</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Communicate</li>
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
            <h3 class="card-title">Add Notice Board</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $getRecord->title }}" required placeholder="Title">
                </div>

                <div class="form-group">
                    <label>Notice Date</label>
                    <input type="date" class="form-control" name="notice_date" value="{{ $getRecord->notice_date }}" required>
                </div>

                <div class="form-group">
                    <label>Publish Date</label>
                    <input type="date" class="form-control" name="publish_date" value="{{ $getRecord->publish_date }}" required>
                </div>

                @php
                    $message_to_teacher = $getRecord->getMessageToSingle($getRecord->id, 2);
                    $message_to_student = $getRecord->getMessageToSingle($getRecord->id, 3);
                    $message_to_parent = $getRecord->getMessageToSingle($getRecord->id, 4);
                @endphp

                <div class="form-group">
                    <label style="display: block">Message To</label>
                    <label style="margin-right: 50px">
                        <input {{ !empty($message_to_teacher) ? 'checked' : '' }} type="checkbox" value="2" name="message_to[]">Teacher
                    </label>
                    <label style="margin-right: 50px">
                        <input {{ !empty($message_to_student) ? 'checked' : '' }} type="checkbox" value="3" name="message_to[]">Student
                    </label>
                    <label style="margin-right: 50px">
                        <input {{ !empty($message_to_parent) ? 'checked' : '' }} type="checkbox" value="4" name="message_to[]">Parent
                    </label>
                </div>

                <div class="form-group">
                    <label>Message</label>
                    <textarea id="compose-textarea" class="form-control" name="message" style="height: 300px">{{ $getRecord->message }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Update</button>
                <a href="{{ route('admin.communicate.notice_board') }}" class="btn btn-default">Back</a>
            </div>
          </form>
        </div>
    </div>  
  </section>
</div>

@endsection

@section('script')
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js')}}"></script>



<script type="text/javascript">


$(function () {
  $('#compose-textarea').summernote({
    height: 200, 
  });
    
})
</script>
@endsection