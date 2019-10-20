<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <title>SIU | Metaphysical</title>

    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('frontend/css/hover.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">

    @stack('style')

</head>
<body>
<!-- navbar started  -->
<div class="sectionNav">
    <div class="container">
        <nav class="navbar navbar-expand-lg customBg">
            <a class="navbar-brand" href="{{URL::to('/')}}">SIU Metaphysical</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{URL::to('/')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @auth
                      
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('profile')}}">Profile <span class="sr-only">(current)</span></a>
                    </li> 
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('allWish')}}">Wish List <span class="sr-only">(current)</span></a>
                    </li>

                        @endauth
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('submitIdea')}}">Submit Idea <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">

                    <div class="top-right links">

                    @if (Route::has('login'))
                            @auth
                                <li class="nav-item active">
                                    <a href="{{ url('/logout') }}" class="nav-link">Logout</a>

                                </li>
                            @else

                                <li class="nav-item active">
                                    <a href="{{ route('login') }}" class="nav-link">Login</a>

                                </li>

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Register</a>

                                    </li>
                                @endif
                            @endauth

                    @endif
                    </div>


                </ul>

                <div class="profileImage my-2 my-lg-0">
                    <img src="{{asset('frontend/image/Profile_avatar_placeholder_large.png')}}" alt="profile-image">
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- navbar end -->

@yield('content')



<!-- footer started -->
<div id="footerSection">
    <div class="copyright">
        <p> Design and Developed By SIU Metaphysical &copy; 2019 </p>
    </div>
</div>
<!-- footer end -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('frontend/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.full.min.js"></script>
  <script src="{{asset('assets/js/sweetalert.js')}}"></script>
@stack('scripts')
<script>
    $(document).ready(function() {
        $('#search-option-select-1').select2();
        $('#search-option-select-2').select2();
    });

</script>

<script type="text/javascript">
      $( document ).ready(function() {
 $('.upVote').click(function() { 

         $.ajax({
                type: 'post',
                url: '{{route('upVote')}}',
                data: {
                '_token': $('input[name=_token]').val(),
                'id': $(this).data('id'),
                },
                success: function(data) {
                  swal("Poof Your Vote Is Accepted!")
                  .then((value) => {
                    location.reload();
                  });

                }
            }); 

     }); 

 });

</script>
<script type="text/javascript">
      $( document ).ready(function() {
 $('.downVote').click(function() { 

         $.ajax({
                type: 'post',
                url: '{{route('downVote')}}',
                data: {
                '_token': $('input[name=_token]').val(),
                'id': $(this).data('id'),
                },
                success: function(data) {
                  swal("Poof Your Down Vote Is Accepted!")
                  .then((value) => {
                    location.reload();
                  });

                }
            }); 

     }); 

 });

</script>



@if(Session::has('TaskSuccess'))
          <script>
              swal({
                  title: "{{session('TaskSuccess')}} !",
                  text: "{{session('msg')}}!",
                  icon: "success",
                  button: "Ok!",
              });
          </script>
 @endif

 @if(Session::has('TaskError'))
          <script>
              swal({
                  title: "{{session('TaskError')}} !",
                  text: "{{session('msg')}}!",
                  icon: "error",
                  button: "Ok!",
              });
          </script>
 @endif


</body>
</html>
