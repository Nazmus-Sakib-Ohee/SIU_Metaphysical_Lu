<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <title>Admin|University </title>
        <!--[if lt IE 10]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="#">
        <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
        <meta name="author" content="#">
        <link rel="icon" href="{{asset('assets\images\logo-blue.png')}}" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/themify-icons/themify-icons.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/icofont/css/icofont.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/themify-icons/themify-icons.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/feather.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/pages/j-pro/css/demo.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/pages/j-pro/css/j-pro-modern.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/pages/bower_components/css/jquery.steps.css')}}">

        <link rel="stylesheet" type="text/css" href="{{asset('css/back/bootstrap_table.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/back/style.css')}}">
 

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>
    <body>
        <div class="theme-loader">
            <div class="ball-scale">
                <div class='contain'>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">
                        <div class="navbar-logo">
                            <a class="mobile-menu" id="mobile-collapse" href="#">
                            <i class="feather icon-menu"></i>
                            </a>
                            <a href="{{route('dashboard')}}">
                            <img class="img-fluid" src="{{asset('assets\images\logo.png')}}" alt="Theme-Logo" />
                            </a>
                            <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                            </a>
                        </div>
                        <div class="navbar-container container-fluid">
                            <ul class="nav-left">
                           
                                <li>
                                    <a href="#!" onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" data-cf-modified-f380765b4bde004ad4666144-="">
                                    <i class="feather icon-maximize full-screen"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                     
                         
                                <li class="user-profile header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="{{asset('assets/images/avatar-4.jpg')}}" class="img-radius" alt="User-Profile-Image">
                                            <span>{{Auth::user()->name}}</span>
                                            <i class="feather icon-chevron-down"></i>
                                        </div>
                                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        
                                            <li>
                                                <a href="{{route('users.edit',Auth::user()->id)}}">
                                                <i class="feather icon-user"></i> Edit
                                                </a>
                                            </li>
                                      
                                            <li>
                                                <a href="{{route('logout')}}">
                                                <i class="feather icon-log-out"></i> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                @csrf


             