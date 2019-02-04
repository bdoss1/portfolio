@if($entry->isApproved())
    <a href="#" data-comment-id="{{$entry->id}}" class="unapprove-comment_js btn btn-xs btn-default">
        <i class="fa fa-ban"></i> Un Approve
    </a>
@else
    <a href="#" data-comment-id="{{$entry->id}}" class="approve-comment_js btn btn-xs btn-default">
        <i class="fa fa-check"></i> Approve
    </a>
@endif


