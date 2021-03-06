<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Learn better, together.">
        <meta name="author" content="Federico A. Maglayon">
        <link rel="shortcut icon" href="/assets/ico/favicon.png">

        <title>eLinet | Learn better, together | Sign up, Sign in</title>

        <!-- Bootstrap core CSS -->
        <link href="/assets/css/bootstrap.css" rel="stylesheet">
        <!-- Global CSS -->
        <link href="/assets/css/site/global.style.css" rel="stylesheet">
        <style>
            body { padding-top: 0; }
            .header .text-muted {
                color: #161616;
                font-weight: bold;
                padding-top: 6px;
                position: relative;
            }

            .header .logo-holders li:first-child { padding: 24px 20px 0; }
            .header .logo-holders li:last-child { padding: 10px 0; }
            .header .logo-holders li:first-child img { width: 110px;}
            .header .logo-holders li:last-child img { width: 80px; }
            .main-content { min-height: 450px; padding-top: 20px; }
            .left-panel { color: #fff; margin: auto !important; width: 400px; }
            .left-panel h1 { font-size: 64px; text-shadow: 0 0 10px #000; }
            .right-panel { width: 350px; margin: auto !important; }
            .left-panel p { font-size: 22px; text-shadow: 0 0 10px #000; }

            /* Right Panel */
            .right-panel {
                background: rgb(245, 245, 245);
                background: rgba(245, 245, 245, 0.7);
                min-height: 350px;
            }

            /* Signin */
            .signin-form .section-title { font-size: 18px; }
            .signin-form form { padding-top: 20px; }
            .signin-form form .alert { margin-bottom: 5px; padding: 8px 10px; }
            .signin-form .signup-options { padding-top: 20px; text-align: center; }
            /* Teacher Signup */
            .teacher-signup-form { display: none; }
            .teacher-signup-form .section-title { font-size: 18px; }
            .teacher-signup-form form { padding-top: 20px; }
            .teacher-signup-form form .form-group .alert { margin-bottom: 5px; padding: 8px 10px; }
            /* Student Signup */
            .student-signup-form { display: none; }
            .student-signup-form .section-title { font-size: 18px; }
            .student-signup-form form { padding-top: 20px; }

            .teacher-signup-form form .notice,
            .student-signup-form form .notice { margin-top: 10px; }
            /* Footer */
            .footer { font-size: 13px; margin-top: 30px; padding: 20px 0; position: relative; text-align: center; }
            /* Background Image */
            .bg {
               min-height: 100%;
               min-width: 1024px;
               width: 100%;
               height: auto;
               position: fixed;
               top: 0;
               left: 0;
               z-index: 0;
               display: none;
             }
        </style>
    </head>

    <body>
        <img src="/assets/images/splash_image.jpg" class="bg">
        <!-- Header -->
        <div class="header container">
            <ul class="nav nav-pills pull-right logo-holders">
                <li><img src="/assets/images/lorma.png"></li>
                <li><img src="/assets/images/ccse.png"></li>
            </ul>
            <h1 class="text-muted"><!-- <img src="/assets/images/logo.png"> -->
                eLinet: e-Learning Courseware in Network Management Course
            </h1>
        </div>

        <div class="main-content container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-panel">
                        <h1>Learn better, together.</h1>
                        <p>
                            eLinet helps connect all learners with the people
                            and resources needed to reach their full potential
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-panel well">
                        <div class="signin-form">
                            <div class="section-title">Sign in to eLinet.</div>
                            {{ Form::open(array('url'=>'users/validate_signin', 'autocomplete' => 'off')) }}
                                @if(isset($loginError))
                                <div class="alert alert-danger">{{ $loginError }}</div>
                                @endif

                                <div class="form-group">
                                    <input type="text" name="signin-username-email" class="form-control"
                                    id="signin_username_email" placeholder="Username or Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="signin-password" class="form-control"
                                    id="signin_password" placeholder="Password">
                                </div>
                                <div class="form-buttons">
                                    <button type="submit" class="btn btn-default pull-right">Login</button>
                                </div>
                                <div class="clearfix"></div>
                            {{ Form::close() }}

                            <hr />

                            <div class="section-title"><strong>Sign up now.</strong> It's free.</div>
                            <div class="signup-options">
                                <button class="btn btn-primary" id="show_teacher_form">I'm a Teacher</button>
                                <button class="btn btn-primary" id="show_student_form">I'm a Student</button>
                            </div>
                        </div>

                        <div class="teacher-signup-form">
                            <div class="section-title">Teacher Sign Up</div>
                            {{ Form::open(array('autocomplete' => 'off', 'id' => 'teacher_signup_form')) }}
                                <div class="form-group">
                                    <select name="teacher-title" id="teacher_title"
                                    class="form-control teacher-title">
                                        <option value="">Select Title:</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Dr.">Dr.</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="teacher-firstname" id="teacher_firstname"
                                    class="form-control teacher-firstname" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control teacher-lastname"
                                    name="teacher-lastname" id="teacher_lastname"
                                    placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="teacher-username" id="teacher_username"
                                    class="form-control teacher-username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="teacher-email" id="teacher_email"
                                    class="form-control teacher-email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="teacher-password" id="teacher_password"
                                    class="form-control teacher-password" placeholder="Password">
                                </div>
                                <div class="form-buttons">
                                    <button type="submit" class="btn btn-primary" id="teacher_signup_button">Sign up</button>
                                    <button class="btn btn-default" id="teacher_signup_cancel">Cancel</button>

                                    <p class="notice">
                                        By clicking "Sign up", you agree to our terms
                                        of service and privacy policy.
                                    </p>
                                </div>
                            {{ Form::close() }}
                        </div>

                        <div class="student-signup-form">
                            <div class="section-title">Student Sign Up</div>
                            {{ Form::open(array('autocomplete' => 'off', 'id' => 'student_signup_form')) }}
                                <div class="form-group">
                                    <input type="text" name="student-group-code" id="student_group_code"
                                    class="form-control student-group-code" placeholder="Group Code">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="student-username" id="student_username"
                                    class="form-control student-username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="student-password" id="student_password"
                                    class="form-control student-password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="student-email" id="student_email"
                                    class="form-control student-email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="student-firstname" id="student_firstname"
                                    class="form-control student-firstname" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control student-lastname"
                                    name="student-lastname" id="student_lastname"
                                    placeholder="Last Name">
                                </div>
                                <div class="form-buttons">
                                    <button type="submit" class="btn btn-primary" id="student_signup_button">Sign up</button>
                                    <button class="btn btn-default" id="student_signup_cancel">Cancel</button>

                                    <p class="notice">
                                        By clicking "Sign up", you agree to our terms
                                        of service and privacy policy.
                                    </p>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <ul>
                <li>
                    <strong>eLinet - eLearning Networking &copy; {{ date('Y') }}</strong>
                </li>
                <li>About</li>
                <li>Blog</li>
                <li>Platform</li>
                <li>Press</li>
                <li>Help</li>
                <li>Jobs</li>
                <li>Terms</li>
                <li>Privacy</li>
                <li>Mobile</li>
            </ul>
        </div>

        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/sitefunc/registration.js"></script>
        <script>
            (function($) {
                $('.bg').load(function() {
                    $(this).fadeIn(1000);
                });

                $('.bg').fadeIn(1000);

                var signinForm  = $('.signin-form');
                var teacherForm = $('.teacher-signup-form');
                var studentForm = $('.student-signup-form');

                $('#show_teacher_form').on('click', function() {
                    signinForm.slideUp();
                    setTimeout(function() {
                        teacherForm.slideDown();
                    }, 600);

                    return false;
                });

                $('#show_student_form').on('click', function() {
                    signinForm.slideUp();
                    setTimeout(function() {
                        studentForm.slideDown();
                    }, 600);

                    return false;
                });

                $('#teacher_signup_cancel').on('click', function(e) {
                    teacherForm.slideUp();
                    setTimeout(function() {
                        signinForm.slideDown();
                    }, 600);

                    e.preventDefault();
                });

                $('#student_signup_cancel').on('click', function(e) {
                    studentForm.slideUp();
                    setTimeout(function() {
                        signinForm.slideDown();
                    }, 600);

                    e.preventDefault();
                });
            })(jQuery);
        </script>
    </body>
</html>
