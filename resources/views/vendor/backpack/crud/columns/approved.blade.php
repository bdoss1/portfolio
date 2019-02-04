@if(!$entry->isApproved())
    <div>
        <span><i class="fa fa-square-o"></i></span>
        <span class="hidden">No</span>
    </div>
@else
    <div>
        <span><i class="fa fa-check-square-o"></i></span>
        <span class="hidden">yes</span>
    </div>
@endif
