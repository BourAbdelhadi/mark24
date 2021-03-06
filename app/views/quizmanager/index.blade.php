@extends('templates.master')

@section('title')
Quiz Manager
@stop

@section('internalCss')
<style>
.quiz-manager .manager-sidebar { padding: 5px 0; }
.quiz-manager .manager-sidebar .quiz-title-holder { border-bottom: 1px solid #dfe4e8; padding: 10px; }
.quiz-manager .manager-sidebar .quiz-title-holder .text-muted { display: block; }
.quiz-manager .manager-sidebar .show-type-holder { padding: 10px; }
.quiz-manager .manager-sidebar .show-type-holder .show-type { display: inline-block; width: 120px; }

.quiz-manager .manager-sidebar .student-lists {
    height: 400px;
    overflow: auto;
}

.quiz-manager .manager-sidebar .student-lists ul .group-name a {
    background-color: #757f93;
    border-radius: 0;
    color: #ffffff;
    padding: 12px;
}

.quiz-manager .manager-sidebar .student-lists ul li .show-taker-details {
    background-color: #ffffff;
    border-radius: 0;
}

.quiz-manager .manager-sidebar .student-lists ul li.active .show-taker-details {
    background-color: #f3f5f7;
    color: #2a6496;
}

.quiz-manager .main-panel { padding: 5px 0; }
.quiz-manager .main-panel .quiz-manager-default .default-header { border-bottom: 1px solid #dfe4e8; padding: 10px; }
.quiz-manager .main-panel .quiz-manager-default .quiz-assigned { background-color: #f3f5f7; border-bottom: 1px solid #dfe4e8; padding: 10px; }

.quiz-manager .main-panel .quiz-manager-proper .manager-header { border-bottom: 1px solid #dfe4e8; padding: 10px; }
.quiz-manager .main-panel .quiz-manager-proper .manager-header .taker-details { margin-left: 10px; }
.quiz-manager .main-panel .quiz-manager-proper .manager-header .taker-details h4 { margin: 0 0 5px; }
.quiz-manager .main-panel .quiz-manager-proper .quiz-item-pagination {  }
.quiz-manager .main-panel .quiz-manager-proper .quiz-item-pagination li a { border-radius: 0; border-top: 0; }
.quiz-manager .main-panel .quiz-manager-proper .quiz-item-pagination li:first-child a { border-left: 0; }

.quiz-item-pagination li a { font-weight: bold; }
.quiz-item-pagination li.no-answer a {  }
.quiz-item-pagination li.true-answer a,
.quiz-item-pagination li.true-answer a:hover { color: #5cb85c; }
.quiz-item-pagination li.false-answer a,
.quiz-item-pagination li.false-answer a:hover { color: #d9534f; }
.quiz-item-pagination li.no-grade a,
.quiz-item-pagination li.no-grade a:hover { color: #5bc0de; }

.quiz-manager .main-panel .quiz-manager-proper .user-no-answer-wrapper {
    padding: 100px 0;
    text-align: center;
}

.quiz-manager .main-panel .quiz-manager-default .student-high-scores {
    padding: 10px;
}

.student-high-scores .highscores-holder {
    /*float: left;*/
    list-style: none;
    margin: 0;
    padding: 0;
}

.student-high-scores .highscores-holder li {
    float: left;
    width: 204px;
    margin: 0 15px 25px 0;
    cursor: pointer;
}

.student-high-scores .highscores-holder li img {
    float: left;
    margin-right: 10px;
    width: 80px;
}

.student-high-scores .highscores-holder li .taker-name {
    color: #3784d3;
    font-weight: bold;
    margin: 0;
    padding: 0 0 0 85px;
}

.student-high-scores .highscores-holder li .taker-score {
    font-size: 21px;
}

.question-item-holder .tab-pane { padding: 15px 20px; }
.question-item-holder .tab-pane .question-status { font-size: 13px; }
.question-item-holder .tab-pane .question-text { margin-top: 10px; }

.question-responses {
    border-top: 1px solid #e3e3e3;
    margin-top: 20px;
    padding-top: 10px;
}

.multiple-choice-response-holder {
    margin: 0;
    padding: 0;
    list-style: none;
}

.multiple-choice-response-holder .option-wrapper .option-holder {
    background-color: #ccc;
    height: 60px;
    padding: 1px 1px 3px;
    margin-bottom: 10px;
}

.multiple-choice-response-holder .option-wrapper .option-holder .choice-letter {
    display: inline-block;
    font-weight: bold;
    text-align: center;
    width: 25px;
}

.multiple-choice-response-holder .option-wrapper .option-holder .choice-text {
    background-color: #ffffff;
    display: inline-block;
    height: 57px;
    padding: 5px 10px;
    width: 94.3%;
}

.multiple-choice-response-holder .choice-answer .option-holder {
    background-color: #439724;
}

.multiple-choice-response-holder .choice-answer .option-holder .choice-letter {
    color: #ffffff;
}

.multiple-choice-response-holder .wrong-choice .option-holder {
    background-color: #d93f44;
}

.multiple-choice-response-holder .wrong-choice .option-holder .choice-letter {
    color: #ffffff;
}

.response-identification .student-identification-response { padding: 10px 0; }
.response-identification .student-identification-response.wrong { color: #d9534f; font-weight: bold; }

.answer-ungraded { margin-top: 20px; }
.answer-ungraded .partial-credit-wrapper { display: inline-block; margin-left: 20px; }
.answer-ungraded .partial-credit-wrapper .partial-credit { display: inline-block; width: 50px; }
</style>
@stop
@section('content')
<div class="quiz-manager" data-quiz-id="{{ $quiz->quiz_id }}">
    <div class="row">
        <div class="col-md-3">
            <div class="well manager-sidebar">
                <div class="quiz-title-holder">
                    <a href="#" class="show-default quiz-title">{{ $quiz->title }}</a>
                    <span class="text-muted">
                        Due {{ date('M d, Y', strtotime($post->quiz_due_date)) }}
                    </span>
                </div>
                <div class="show-type-holder">
                    <span>Showing:</span>
                    <select class="show-type form-control" data-quiz-id="{{ $quiz->quiz_id }}">
                        <option value="all" selected>All</option>
                        <option value="ungraded">Ungraded</option>
                        <option value="graded">Graded</option>
                        <option value="not_turned_in">Not turned in</option>
                    </select>
                </div>
                <div class="student-lists">
                    <ul class="list-holder nav nav-pills nav-stacked">
                        @foreach($takers as $taker)
                        <li class="group-name"><a href="#">{{ $taker['group_name'] }}</a></li>
                        @if(isset($taker['members']))
                        @foreach($taker['members'] as $member)
                        <li>
                            <a href="#" class="show-taker-details"
                            data-user-id="{{ $member['id'] }}">
                                {{ $member['firstname'].' '.$member['lastname'] }}
                            </a>
                        </li>
                        @endforeach
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="well main-panel">
                <div class="quiz-manager-default">
                    <div class="default-header">
                        <div class="quiz-details">
                            <h4>{{ $quiz->title }}</h4>
                            <a href="#" class="text-muted">Quiz Overview</a>
                            <a href="#">All Submissions</a>
                        </div>
                    </div>
                    <div class="quiz-assigned">
                        <span>Assigned to:</span>
                        <?php $groupCount = count($takers); ?>
                        @foreach($takers as $key => $taker)
                        @if($groupCount - 1 === $key)
                        <a href="/groups/{{ $taker['group_id'] }}">
                            {{ $taker['group_name'] }}
                        </a>
                        @endif
                        @if($groupCount - 1 !== $key)
                        <a href="/groups/{{ $taker['group_id'] }}">
                            {{ $taker['group_name'] }},
                        </a>
                        @endif
                        @endforeach
                    </div>
                    <div class="student-high-scores">
                        <h4>High scores</h4>
                        @if(!$topnotchers->isEmpty())
                        <ul class="highscores-holder clearfix">
                            @foreach($topnotchers as $topnotcher)
                            <li class="highscorer-details" data-user-id="{{ $topnotcher->id }}">
                                {{ Helper::avatar(80, "normal", "img-rounded", $topnotcher->id) }}
                                <p class="taker-name">{{ $topnotcher->name }}</p>
                                <p class="taker-score text-muted">
                                    {{ $topnotcher->score }}/{{ $quiz->total_score }}
                                </p>
                                <!-- <div class="clearfix"></div> -->
                            </li>
                            @endforeach
                        </ul>

                        @endif
                    </div>
                    <div class="question-breakdown"></div>
                </div>

                <div class="quiz-manager-proper" style="display: none;"></div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript" src="/assets/js/sitefunc/quizmanager.js"></script>
@stop
