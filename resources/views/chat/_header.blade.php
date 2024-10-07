<div class="row">
    <div class="col-lg-12">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
            <img style="height:40px; width:40px" src="{{ $getReceiver->getImageDirect() }}" alt="avatar">
        </a>
        <div class="chat-about">
            <h6 class="m-b-0">{{ $getReceiver->name }}</h6>
            <small>Last seen: {{ Carbon\Carbon::parse($getReceiver->updated_at)->diffForHumans() }}</small>
        </div>
    </div>
</div>