<div class="post-creator-holder">
    <ul class="nav nav-tabs" id="post_creator_options">
        <li class="active"><a href="#note"><i class="icon-edit"></i> Note</a></li>
        <li><a href="#alert"><i class="icon-exclamation-sign"></i> Alert</a></li>
        <li><a href="#assignment"><i class="icon-check"></i> Assigment</a></li>
        <li><a href="#quiz"><i class="icon-question-sign"></i> Quiz</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane well active" id="note">
            {{ Form::open(array('url'=>'ajax/post_creator/create_note')) }}
                <div class="form-group">
                    <div class="alert"></div>
                    <textarea name="note-content" id="note_content" class="postcreator-textarea form-control"
                    placeholder="Type your note here..."></textarea>
                </div>

                <div class="postcreator-hidden">
                    <div class="form-group">
                        <div class="alert"></div>
                        <select name="note-recipients[]" class="post-recipients"
                        id="note_recipients" multiple="true" data-placeholder="Send to...">
                            @foreach($groups as $group)
                            <option value="{{ $group->group_id }}-group">{{ $group->group_name }}</option>
                            @endforeach
                            @foreach($groupMembers as $groupMember)
                            <option value="{{ $groupMember->id }}-user">{{ $groupMember->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="postcreator-form-controls">
                        <ul class="postcreator-controls pull-left">
                            <li><input type="file" name="note-file" id="note_file"></li>
                        </ul>

                        <div class="postcreator-buttons pull-right">
                            <a href="">Cancel</a>
                            <span class="postcreator-send-or">or</span>
                            <button type="submit" id="submit_note" class="btn btn-primary">
                                Send
                            </button>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            {{ Form::close() }}
        </div>

        <div class="tab-pane well" id="alert">
            {{ Form::open(array('url'=>'ajax/post_creator/create_alert')) }}
                <div class="form-group">
                    <textarea name="alert-content" id="alert_content" class="postcreator-textarea form-control"
                    placeholder="Type your alert (140 character max)..."></textarea>
                </div>

                <div class="postcreator-hidden">
                    <div class="form-group">
                        <select name="alert-recipients" class="post-recipients"
                        id="alert_recipients" multiple="true" data-placeholder="Send to...">
                            @foreach($groups as $group)
                            <option value="{{ $group->group_id }}-group">{{ $group->group_name }}</option>
                            @endforeach
                            @foreach($groupMembers as $groupMember)
                            <option value="{{ $groupMember->id }}-user">{{ $groupMember->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="postcreator-form-controls">
                        <ul class="postcreator-controls pull-left">
                            <li></li>
                        </ul>

                        <div class="postcreator-buttons pull-right">
                            <a href="">Cancel</a>
                            <span class="postcreator-send-or">or</span>
                            <button type="submit" id="submit_note" class="btn btn-primary">
                                Send
                            </button>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            {{ Form::close() }}
        </div>

        <div class="tab-pane well" id="assignment">
            Assignment
        </div>
        <div class="tab-pane well" id="quiz">
            <div class="quiz-first-choices">
                <a href="/quiz_creator" class="btn btn-primary">Create a Quiz</a>
                <span class="postcreator-or">or</span>
                <a href="#">Load a previously created Quiz</a>
            </div>
        </div>
    </div>
</div>
