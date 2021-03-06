@extends('templates.master')

@section('title')
The Forum
@stop

@section('internalCss')
<style>
.the-forum .post-thread-link { margin-bottom: 10px; }
.the-forum .forum-category-holder { margin-bottom: 10px; }
.the-forum .forum-category-holder .title-holder {
    background-color: #757f93;
    color: #ffffff;
    padding: 12px;
}

.the-forum .forum-category-holder ul li { margin: 0; }
.the-forum .forum-category-holder ul li.active a {
    background-color: #f3f5f7;
    color: #2a6496;
}

.the-forum .forum-category-holder ul li a {
    background-color: #ffffff;
    border: 1px solid #dfe4e8 !important;
    border-top: 0 !important;
    border-radius: 0;
}

.the-forum .add-forum-category { margin-bottom: 20px; }
.the-forum .forum-add-thread textarea { height: 200px; resize: none; }
</style>
@if(isset($group))
<link href="/assets/css/site/group.style.css" rel="stylesheet">
@endif
@stop

@section('content')
<div class="row the-forum">
    <div class="col-md-3">
        @if(isset($group))
        @include('plugins/groupdetails')
        @endif

        @if(isset($group))
        <a href="/groups/{{ $group->group_id }}/the-forum/add-thread"
        class="btn btn-info btn-large btn-block post-thread-link">
            Post a Thread
        </a>
        @else
        <a href="/the-forum/add-thread" class="btn btn-info btn-large btn-block post-thread-link">
            Post a Thread
        </a>
        @endif

        <div class="forum-category-holder">
            <div class="title-holder">Forum Categories</div>
            <ul class="nav nav-pills nav-stacked">
                @if(isset($group))
                <li class="active"><a href="/groups/{{ $group->group_id }}/the-forum">Home</a></li>
                @foreach($categories as $category)
                <li>
                    <a href="/groups/{{ $group->group_id }}/the-forum/{{ $category->seo_name }}">
                        {{ $category->category_name }}
                    </a>
                </li>
                @endforeach
                @else
                <li class="active"><a href="/the-forum">Home</a></li>
                @foreach($categories as $category)
                <li><a href="/the-forum/{{ $category->seo_name }}">{{ $category->category_name }}</a></li>
                @endforeach
                @endif
            </ul>
        </div>

        @if(Auth::user()->account_type == 1)
        <a href="#" class="btn btn-primary btn-large btn-block add-forum-category">
            Add Forum Category
        </a>
        @endif
    </div>

    <div class="col-md-9">
        <div class="well forum-add-thread">
            {{ Form::open(array('url' => 'the-forum/submit-new-thread')) }}
                <div class="form-group
                <?php echo (!$errors->has('thread-title')) ? null : 'has-error'; ?>">
                    @if($errors->has('thread-title'))
                    <span class="help-block">{{ $errors->first('thread-title') }}</span>
                    @endif
                    <input type="text" name="thread-title" class="form-control"
                    placeholder="Choose a thread title" value="{{ Input::old('thread-title') }}">
                </div>
                <div class="form-group
                <?php echo (!$errors->has('thread-category')) ? null : 'has-error'; ?>">
                    @if($errors->has('thread-category'))
                    <span class="help-block">{{ $errors->first('thread-category') }}</span>
                    @endif
                    <select name="thread-category" class="form-control">
                        <option value="" selected>-- Choose a category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->forum_category_id }}"
                        <?php echo (Input::old('thread-category') == $category->forum_category_id) ? 'selected' : null; ?>>
                            {{ $category->category_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group
                <?php echo (!$errors->has('thread-description')) ? null : 'has-error'; ?>">
                    @if($errors->has('thread-description'))
                    <span class="help-block">{{ $errors->first('thread-description') }}</span>
                    @endif
                    <textarea name="thread-description" class="form-control"
                    placeholder="Write your first post here">{{ Input::old('thread-description') }}</textarea>
                </div>

                @if(Auth::user()->account_type == 1)
                <div class="checkbox">
                    <label><input name="sticky-post" type="checkbox" value="TRUE"> Sticky post?</label>
                </div>
                @endif

                @if(isset($group))
                <input type="hidden" name="group-id" value="{{ $group->group_id }}">
                @endif
                <button type="submit" class="btn btn-default">Post Thread</button>
            {{ Form::close() }}
        </div>
    </div>
</div>

@stop

@section('js')
<script type="text/javascript" src="/assets/js/sitefunc/theforum.js"></script>
@stop
