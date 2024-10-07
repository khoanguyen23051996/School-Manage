@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
<style type="text/css">
    .select2-container .select2-selection--single
    {
        height: 40px;
    }
</style>
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Send Email</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Send Email</li>
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
          <!-- /.card-header -->
          <!-- form start -->
          @include('auth._message')
          <form method="POST" action="">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Subject</label>
                <input type="text" class="form-control" name="subject" required placeholder="Subject">
              </div>

              <div class="form-group">
                <label>User</label>
                <select class="form-control select2" style="width:100%" name="user_id">
                    <option value="">--- Select ---</option>
                </select>
              </div>

              <div class="form-group">
                <label style="display: block">Message To</label>
                <label style="margin-right: 50px"><input type="checkbox" value="2" name="message_to[]">Teacher</label>
                <label style="margin-right: 50px"><input type="checkbox" value="3" name="message_to[]">Student</label>
                <label style="margin-right: 50px"><input type="checkbox" value="4" name="message_to[]">Parent</label>
              </div>

              <div class="form-group">
                <label>Message</label>
                <textarea id="compose-textarea" class="form-control" name="message" style="height: 300px"></textarea>
              </div>
             

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Send</button>
            </div>
          </form>
        </div>
    </div>  
  </section>
</div>

@endsection

@section('script')
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
$(function () {
    $('.select2').select2({
        ajax: {
            url: '{{ url('admin/communicate/search_user') }}',
            dataType: 'json',
            delay: 250,
            data: function(data){
                return {
                    search: data.term,  
                };
            },
            processResults: function(response){
                return {
                    results: response
                };
            },
        }
    });

  $('#compose-textarea').summernote({
    height: 200, 
  });
    
})
</script>
@endsection