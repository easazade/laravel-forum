<div class="panel-heading">
    <span style="color: dodgerblue;">{{ $reply->owner->name }}</span> said
    {{ $reply->created_at->diffForHumans() }}
</div>
<div class="panel-body">{{ $reply->body }}</div>
<hr>
