@extends('frontend.layout-master')


@section('content')

    <!-- main section started -->

    <div id="mainBox">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="home-left-bar">
                        <div class="left-side-bar">
                            <div class="cardDesign">
                                <div class="card-group">
                                    <div class="card br-zero">
                                        <img src="frontend/image/Profile_avatar_placeholder_large.png" class="card-img-top" alt="Image">
                                        <div class="card-body">
                                            <h5 class="card-title">{{Auth::user()->name}}</h5>
                                            <small class="text-center">User</small>
                                            <div id="line"></div>
                                        </div>
                                        <!-- Biography -->
                                   
                                        <!-- end -->
                                        <!-- card footer started -->
                                           <div class="card-footer">
                                        <small class="text-muted">User Since {{Auth::user()->created_at->diffForHumans()}}</small>
                                    </div>
                                        <!-- card footer end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="home-middle-section">
                        <div class="submit_post">
                            <div class="inner_submit_post">

                                <form action="{{route('storeIdea')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Idea Title <span style="color: red">*</span></label>
                                        <input type="text" name="title" value="{{old('title')}}" required class="form-control custom-search" placeholder="Enter Idea Title">

                                         @if (count($errors) > 0)
                                        <span style="color:red">
                                        {!! $errors->first('title') !!}
                                        </span>
                                        @endif
                                       
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Choose an image that best represent your idea (Optional)</label>
                                        <input type="file" name="image" class="form-control-file custom-search" id="image">

                                         @if (count($errors) > 0)
                                        <span style="color:red">
                                        {!! $errors->first('image') !!}
                                        </span>
                                        @endif
                                      
                                    </div>

                                    <div class="form-group">
                                        <label for="idea_description">Describe your idea <span style="color: red">*</span></label>
                                        <textarea name="idea_description" value="{{old('idea_description')}}" required id="idea_description" cols="30" rows="10"></textarea>
                                            @if (count($errors) > 0)
                                        <span style="color:red">
                                        {!! $errors->first('idea_description') !!}
                                        </span>
                                        @endif
                                      
                                    </div>
                                    <div class="form-group">
                                        <label for="pptx">Choose a power point slider (Optional)</label>
                                        <input type="file" name="pptx" class="form-control-file custom-search" id="pptx">
                                           @if (count($errors) > 0)
                                        <span style="color:red">
                                        {!! $errors->first('pptx') !!}
                                        </span>
                                        @endif
                                    </div>


                                    <label for="tags">Type Relevant Tags <span style="color: red">*</span></label>
                                    <select class="form-control" name="tags[]"  required multiple="multiple" id="multi_select"></select>

                                          @if (count($errors) > 0)
                                        <span style="color:red">
                                        {!! $errors->first('tags.*') !!}
                                        </span>
                                        @endif

                                    <button type="submit" class="btn btn-success search-button align-content-center" style="margin-top: 15px;">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

      


            </div>
        </div>
    </div>
    <!-- main section end -->



@endsection

@push('scripts')
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>

    <script>




        $("#multi_select").select2({
            tags: true,
            tokenSeparators: [',']
        })
    </script>


@endpush
