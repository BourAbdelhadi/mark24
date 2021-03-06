@extends('templates.master')

@section('title')
{{ $groupDetails->group_name }}
@stop

@section('internalCss')
<link href="/assets/css/site/group.style.css" rel="stylesheet">
<link href="/assets/css/plugins/postcreator.style.css" rel="stylesheet">
<link href="/assets/css/plugins/poststream.style.css" rel="stylesheet">
<link href="/assets/css/plugins/chosen.css" rel="stylesheet">
<style type="text/css">

</style>
@stop

@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Left Sidebar -->
        <div class="group-details-holder well">
            <div class="group-details-content">
                <div class="dropdown pull-right">
                    <a data-toggle="dropdown" href="#">
                        <i class="fa fa-gear"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        @if(Auth::user()->account_type == 1)
                        <li>
                            <a href="#" id="show_settings_modal"
                            data-group-id="{{ $groupDetails->group_id }}">
                                Group Settings
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->account_type == 2)
                        <li><a href="#" id="leave_group" data-group-id="{{ $groupDetails->group_id }}">Withdraw</a></li>
                        @endif
                    </ul>
                </div>
                <div class="group-name">{{ $groupDetails->group_name }}</div>
                <div class="text-muted">Group</div>
            </div>

            @if(Auth::user()->account_type == 1)
            <div class="group-code-holder">
                <div class="group-code-title">Group Code</div>
                @if($groupDetails->group_code == 'LOCKED')
                <a href="#" class="pull-left unlock-group" data-group-id="{{ $groupDetails->group_id }}">
                    <i class="group-code-icon fa fa-lock"></i>
                </a>
                @else
                <a href="#" class="pull-left lock-group" data-group-id="{{ $groupDetails->group_id }}">
                    <i class="group-code-icon fa fa-unlock"></i>
                </a>
                @endif
                <div class="group-code-control input-group pull-left">
                    <input type="text" class="group-code form-control" readonly
                    value="<?php echo ($groupDetails->group_code == 'LOCKED') ? 'LOCKED' : $groupDetails->group_code; ?>">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="#" class="reset-group-code"
                                data-group-id="{{ $groupDetails->group_id }}">Reset</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            @endif

            <ul class="nav nav-pills nav-stacked group-controls">
                <li class="active">
                    <a href="/groups/{{ $groupDetails->group_id }}">
                        <i class="fa fa-chevron-right pull-right"></i>
                        <i class="group-control-icon fa fa-comment"></i> Posts
                    </a>
                </li>
                <li>
                    <a href="/groups/{{ $groupDetails->group_id }}/members">
                        <i class="fa fa-chevron-right pull-right"></i>
                        <i class="group-control-icon fa fa-user"></i> Members
                        <span class="label label-success pull-right">{{ $stats['member_count'] }} joined</span>
                    </a>
                </li>
                <li>
                    <a href="/groups/{{ $groupDetails->group_id }}/the-forum">
                        <i class="fa fa-chevron-right pull-right"></i>
                        <i class="group-control-icon fa fa-comments-o"></i> Group Forums
                    </a>
                </li>
                <li>
                    <a href="/groups/{{ $groupDetails->group_id }}/the-library">
                        <i class="fa fa-chevron-right pull-right"></i>
                        <i class="group-control-icon fa fa-archive"></i> Group Library
                    </a>
                </li>
                @if(Auth::user()->account_type == 1)
                <li>
                    <a href="/groups/{{ $groupDetails->group_id }}/join-requests">
                        <i class="group-control-icon fa fa-plus"></i> Join Requests
                        <span class="label label-danger pull-right">{{ $stats['join_requests'] }}</span>
                    </a>
                </li>
                <li>
                    @if(empty($ongoingGroupChat))
                    <a href="#" class="show-start-chat"
                    data-group-id="{{ $groupDetails->group_id }}">
                        <i class="group-control-icon fa fa-comments"></i> Start Group Chat
                    </a>
                    @endif
                    @if(!empty($ongoingGroupChat))
                    <a href="/groups/{{ $groupDetails->group_id }}/chat/{{ $ongoingGroupChat->conversation_id }}">
                        <i class="group-control-icon fa fa-comments"></i> Join Group Chat
                        <i class="fa fa-exclamation-circle ongoing-chat pull-right"></i>
                    </a>
                    @endif
                </li>
                <li>
                    <a href="/groups/{{ $groupDetails->group_id }}/chat-archives">
                        <i class="fa fa-chevron-right pull-right"></i>
                        <i class="fa fa-list-alt group-control-icon"></i> Chat Archives
                    </a>
                </li>
                @endif
                @if(Auth::user()->account_type == 2 && !empty($ongoingGroupChat))
                <li>
                    <a href="/groups/{{ $groupDetails->group_id }}/chat/{{ $ongoingGroupChat->conversation_id }}">
                        <i class="group-control-icon fa fa-comments"></i> Join Group Chat
                        <i class="fa fa-exclamation-circle ongoing-chat pull-right"></i>
                    </a>
                </li>
                @endif
            </ul>

            <div class="group-description-holder">{{ $groupDetails->group_description }}</div>
        </div>

        <div class="user-groups-holder">
            <div class="section-title-holder">
                <span>Other Groups</span>
                <div class="dropdown pull-right">
                    <a data-toggle="dropdown" href="#" id="group_options">
                        <i class="fa fa-plus-circle"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        @if(Auth::user()->account_type == 1)
                        <li><a href="#" id="show_create_group">Create</a></li>
                        @endif
                        <li><a href="#" id="show_join_group">Join</a></li>
                    </ul>
                </div>
            </div>
            <ul class="nav nav-pills nav-stacked">
                @foreach($groups as $group)
                <li class="<?php echo ($group->group_id == $groupDetails->group_id) ? 'active' : null; ?>">
                    <a href="/groups/{{ $group->group_id }}">{{ $group->group_name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-md-9">
        <!-- Main Content -->
        @include('plugins.postcreator')

        <?php $properties = array_filter(get_object_vars($groupChats)); ?>
        @if(!empty($properties))
        <div class="group-chat-notification alert alert-info">
            <strong>Hey, there's an ongoing group chat! It seems you need to join.</strong>
            <ul class="group-chats">
                @foreach($groupChats as $groupChat)
                <li>
                    <a href="/groups/{{ $groupChat->group_id }}">{{ $groupChat->group_name }}</a>
                    <a href="/groups/{{ $groupChat->group_id }}/chat/{{ $groupChat->conversation->conversation_id }}"
                    class="btn btn-info">
                        Join group chat!
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @include('plugins.poststream')
    </div>
</div>

@stop

@section('js')
<script src="/assets/js/plugins/jquery.form.min.js"></script>
<script src="/assets/js/plugins/chosen.js"></script>
<script src="/assets/js/plugins/expanding.js"></script>
<script src="/assets/js/plugins/bootstrap-datepicker.js"></script>

<script src="/assets/js/sitefunc/postcreator.js"></script>
<script src="/assets/js/sitefunc/comment.creator.js"></script>
<script src="/assets/js/sitefunc/poststream.js"></script>
<script src="/assets/js/sitefunc/groups.js"></script>

@if(Auth::user()->account_type == 1)
<!-- File Upload -->
<script src="/assets/js/plugins/jquery.ui.widget.js"></script>
<script src="/assets/js/plugins/jquery.iframe-transport.js"></script>
<script src="/assets/js/plugins/jquery.fileupload.js"></script>
<script src="/assets/js/sitefunc/postcreator.uploader.js"></script>
<script>
// file upload
$(function () {
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var checkin = $('.assignment-due-date').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        },
        format : 'yyyy-mm-dd'
    }).on('changeDate', function(ev) {
        checkin.hide();
    }).data('datepicker');
});
</script>
@endif
@stop
