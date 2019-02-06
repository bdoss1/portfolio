@if(count($items) > 0)

    <hr class="top_90 bottom_90 col-md-8">

    <div class="owl-carousel work-areas text-center top_90 bottom_90 col-md-10 offset-md-1"
         data-pagination="true" data-autoplay="3000" data-items-desktop="1" data-items-desktop-small="1"
         data-items-tablet="1" data-items-tablet-small="1">
    @foreach($items as $item)
        <!-- an area -->
            <div class="area col-md-12 item">
                <i class="flaticon-024-computer-graphic"></i>
                <h3 class="title" class="title">
                    @if(!empty($item->author_url)) <span onclick="$('#comment_author_{{$item->id}}').submit()"
                                                         class="profile_link"> @endif
                        {{ $item->author_name }}
                        @if(!empty($item->author_url)) </span> @endif
                </h3>
                @if(!empty($item->author_url))
                    <form id="comment_author_{{$item->id}}" target="_blank" style="display: none;"
                          action="{{ route('redirect') }}" method="POST">
                        @csrf
                        <input type="hidden" name="value" value="{{ encrypt($item->author_url) }}">
                    </form>
                @endif
                <div class="line"></div>
                <p>
                    {{ $item->content }} @if($item->review_url) <span
                            onclick="$('#comment_review_{{$item->id}}').submit()"
                            class="link-style">[@lang('custom.review_url')]</span> @endif
                </p>
                @if($item->review_url)
                    <form id="comment_review_{{$item->id}}" target="_blank" style="display: none;"
                          action="{{ route('redirect') }}" method="POST">
                        <input type="hidden" name="value" value="{{ encrypt($item->review_url) }}">
                        @csrf
                    </form>
                @endif

                @if($item->image) <a data-fancybox="reviews" data-caption="{{ $item->content }}"
                                     href="{{ $item->image }}">@lang('custom.review_photo')</a> @endif
            </div>
        @endforeach
    </div>
@endif
