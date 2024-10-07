<div class="chat-header clearfix">
@include('chat._header')
</div>

<div class="chat-history">
@include('chat._chat')
</div>

<div class="chat-message clearfix">
    <form action="" method="post" id="submit_message" class="mb-0" >
        <input type="hidden" name="receiver_id" value="{{ $getReceiver->id }}">
        @csrf
        <textarea name="message" id="ClearMessage" class="form-control"></textarea>
        <div class="row">
            <div class="col-md-6 hident-sm" style="margin-top: 20px">
                <div class="col-lg-6 hidden-sm">
                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                </div>
            </div>
            <div class="col-md-6" style="text-align: right">
                <button style="margin: 20px 0px 0px 20px" class="btn btn-primary" type="submit">Send</button>
            </div>
        </div>
    </form>
</div>