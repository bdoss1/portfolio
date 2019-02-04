<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i>
        <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href='{{ backpack_url('portfolio') }}'><i class='fa fa-support'></i> <span>@lang('custom.portfolio')</span></a>
</li>
<li><a href='{{ backpack_url('blog') }}'><i class='fa fa-newspaper-o'></i> <span>@lang('custom.blog')</span></a></li>
<li><a href='{{ backpack_url('category') }}'><i class='fa fa-clone'></i> <span>@lang('custom.categories')</span></a>
</li>
<li><a href='{{ backpack_url('comment') }}'><i class='fa fa-commenting'></i>
        <span>@lang('comment::comment.title')</span></a>
</li>
<li><a href="{{ backpack_url('page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>
<li><a href="{{ backpack_url('form') }}"><i class="fa fa-envelope"></i> <span>Forms</span></a></li>
<li><a href="{{ backpack_url('review') }}"><i class="fa fa-th"></i> <span>Reviews</span></a></li>

<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i>
        <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i
            class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
        <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
        <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
<li><a href='{{ backpack_url('setting') }}'><i class='fa fa-cog'></i> <span>Settings</span></a></li>

@push('after_scripts')
    <style>
        .approved {
            display: none;
        }

        .approved_visible {
            display: inline-block;
        }
    </style>
    <script>
        $(document).on('click', '.unapprove-comment_js', function (e) {
            e.preventDefault();
            $comment_id = $(this).attr('data-comment-id');

            $.ajax({
                type: "POST",
                url: '{{ route('admin.comment.un_approve')  }}',
                data: {comments: $comment_id},
                success: function (response) {
                    if (response.success) {
                        new PNotify({
                            title: "Un approved",
                            text: response.message,
                            type: "success"
                        });

                        var ajax_table = $('#crudTable').DataTable();
                        var current_url = ajax_table.ajax.url();
                        ajax_table.ajax.url(current_url).load();
                    } else {
                        new PNotify({
                            title: "Not un approved",
                            text: response.message,
                            type: "error"
                        });
                    }
                }
            });
        });

        $(document).on('click', '.approve-comment_js', function (e) {
            e.preventDefault();
            $comment_id = $(this).attr('data-comment-id');

            $.ajax({
                type: "POST",
                url: '{{ route('admin.comment.approve')  }}',
                data: {comments: $comment_id},
                success: function (response) {
                    if (response.success) {
                        var ajax_table = $('#crudTable').DataTable();
                        var current_url = ajax_table.ajax.url();
                        ajax_table.ajax.url(current_url).load();

                        new PNotify({
                            title: "Approved",
                            text: response.message,
                            type: "success"
                        });
                    } else {
                        new PNotify({
                            title: "Not approved",
                            text: response.message,
                            type: "error"
                        });
                    }
                }
            });
        });
    </script>
@endpush
