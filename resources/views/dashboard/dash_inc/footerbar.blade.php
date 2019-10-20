    
    
            </div>
        </div>
        <!--[if lt IE 10]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="../files/assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="../files/assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="../files/assets/images/browser/ie.png" alt="">
                            <div>IE (9 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
        <![endif]-->
        <script  data-cfasync="false" src="{{asset('assets/js/email-decode.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('assets/js/modernizr.js')}}"></script>
        <script src="{{asset('assets/js/Chart.js')}}"></script>
        <script src="{{asset('assets/js/amcharts.js')}}"></script>
        <script src="{{asset('assets/js/serial.js')}}"></script>
        <script src="{{asset('assets/js/light.js')}}"></script>
        <script src="{{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{asset('assets/js/SmoothScroll.js')}}"></script>
        <script src="{{asset('assets/js/pcoded.min.js')}}"></script>
        <script src="{{asset('assets/pages/bower_components/js/jquery.steps.js')}}"></script>
        <script src="{{asset('assets/pages/bower_components/js/jquery.validate.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
        <script src="{{asset('assets/pages/form-validation/validate.js')}}"></script>
        <script src="{{asset('assets/pages/forms-wizard-validation/form-wizard.js')}}"></script>

        <script src="{{asset('assets/js/vartical-layout.min.js')}}"></script>
        <script src="{{asset('assets/js/custom-dashboard.min.js')}}"></script>
        <script src="{{asset('assets/js/script.js')}}"></script>
        <script src="{{asset('assets/js/SmoothScroll.js')}}"></script>
        <script src="{{asset('assets/js/sweetalert.js')}}"></script>

        <script src="{{asset('js/back/mindmup-editabletable.js')}}"></script>
        <script src="{{asset('js/back/bootstrap-table.min.js')}}"></script>
        <script src="{{asset('js/back/tableExport.min.js')}}"></script>
        <script src="{{asset('js/back/bootstrap_tables.js')}}"></script>
        
    <script src="http://erpschoolmanagement.nevadiatechnology.com/js/canvasjs.min.js"></script>
        <script type="text/javascript">
            window.dataLayer = window.dataLayer || [];
            
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            
            gtag('config', 'UA-23581568-13');
        </script>
               <script src="{{asset('assets/js/rocket-loader.min.js')}}"  data-cf-settings="f380765b4bde004ad4666144-|49" defer=""></script>


@stack('custom-scripts')


        <script>
            $(document).on('click', '.showDescription', function() {
                      var desc=$(this).data('description');
                      swal({
                  title: "Description",
                  text: desc,
                  icon: "warning",
                })
               
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


 <script>
             $(document).on('click', '.DeleteContent', function() {
                      var sname=$(this).data('name');
                      var urlEx=$(this).data('url');
                      swal({
                  title: "Delete "+sname+"?",
                  text: "Once deleted, you will not be able to recover this data!",
                  icon: "error",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                        $.ajax({
                        type: 'post',
                        url: urlEx,
                        data: {
                        '_token': $('input[name=_token]').val(),
                        'id': $(this).data('id'),
                        'picture': $(this).data('pic'),
                        },
                        success: function(data) {
                          swal("Poof! This data has been deleted!")
                          .then((value) => {
                            location.reload();
                          });

                        }
                        });

                    
                  } else {
                    swal("This data is safe!");
                  }
                });
               });
 </script>

   
            <script>


            $(document).on('click', '.showDescription', function() {
                      var desc=$(this).data('description');
                      swal({
                  title: "Description",
                  text: desc,
                  icon: "warning",
                })
               
               });

               </script>


<script>
        $('#ButtonRefresh').click(function(){
            location.reload();

        });
</script>



  </body>
</html>