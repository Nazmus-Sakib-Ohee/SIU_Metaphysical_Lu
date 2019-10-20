@extends('frontend.layout-master')


@section('content')
    <!-- main section started -->

    <div id="mainBox">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="left-side-bar">
                        <div class="cardDesign">
                            <div class="card-group">
                                <div class="card br-zero">
                                    <img src="{{asset('frontend/image/Profile_avatar_placeholder_large.png')}}" class="card-img-top" alt="Image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{Auth::user()->name}}</h5>
                                        <small>User</small>
                                        <div id="line"></div>
                                    </div>
                                

                                    <div class="card-footer">
                                        <small class="text-muted">User Since {{Auth::user()->created_at->diffForHumans()}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="right-side-bar">
                        <div class="card mr-b">
                            <div class="headeLabel alert-danger">
                                <a href="">User Activities</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Ideas</h6>

                                        <div class="row borderline">
                                            <div class="col-md-8">
                                                <p>Total submitted ideas</p>
                                            </div>
                                            <div class="col-md-4"><b>{{$totalIdea}}</b></div>
                                        </div> 
                                        <div class="row borderline">
                                            <div class="col-md-8">
                                                <p>New</p>
                                            </div>
                                            <div class="col-md-4"><b>{{$totalIdeaNew}}</b></div>
                                        </div>
                                                                 <div class="row borderline">
                                            <div class="col-md-8">
                                                <p>Completed</p>
                                            </div>
                                            <div class="col-md-4"><b>{{$totalIdeaCompleted}}</b></div>
                                        </div>                          <div class="row borderline">
                                            <div class="col-md-8">
                                                <p>In-Progress</p>
                                            </div>
                                            <div class="col-md-4"><b>{{$totalIdeaInProgress}}</b></div>
                                        </div> 

                                        <div class="row borderline">
                                            <div class="col-md-8">
                                                <p>On-Hold</p>
                                            </div>
                                            <div class="col-md-4"><b>{{$totalIdeaOnHold}}</b></div>
                                        </div>

                                          
                                    </div>
                                 
                                </div>
                            </div>
                        </div>


                    
                    </div>
             
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-9">
                    @if(isset($Ideas))
                    @foreach ($Ideas as $data)
                    <div class="home-middle-section">
                        <div class="post-section">
                            <div class="card">
                                <div class="card-body">
                                    <div class="post-header-area">
                                        <div class="post-profile-img">
                                           <img src="frontend/image/Profile_avatar_placeholder_large.png" class="card-img-top" alt="Image">
                                           
                                            <div class="name-with-post-time">
                                                <p><a class="post-owner-name" href="#">{{$data->user->name}}</a></p>
                                                <span><i class="fas fa-clock"></i> &nbsp; {{$data->created_at->diffForHumans()}} &nbsp;&nbsp;</span>

                                 @php
                               $date = \Carbon\Carbon::parse($data->created_at, 'UTC');
                               @endphp
                               <span><i class="fas fa-calendar-alt"></i> &nbsp; {{$date->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</span>
                                
                                            </div>
                                            @auth
                                            <div class="post-setting-left">
                                                @php 
                                                $userId=Auth::user()->id;
                                                $wishCheck=\App\Wish::where('idea_id',$data->id)->where('user_id',Auth::user()->id)->exists();
                                                
                                            @endphp
                                            @if($wishCheck)
<a href="{{route('removeWish',$data->id)}}" class="btn btn-danger" style="border-radius:0;"><i class="fas fa-times-circle" style="color:#fff"></i></a>
                                            @else 
<a href="{{route('addWish',$data->id)}}" class="btn btn-success" style="border-radius:0;"><i class="fas fa-bookmark" style="color:#fff"></i></a>
                                            @endif
                                            
                                        </div>
                                         @endauth
                                        </div>
                                    </div>
                                </div>
                                <div class="post-body">
                                    <h5 style="font-weight: bold;"><a class="post-title" href="#">{{$data->title}}</a></h5>
                                     <p style="float: right;color: green"><strong>{{$data->status}}</strong></p>
                                    <div class="post-related-tag">
                                        <ul class="m-p-zero-l-none">

                                            @foreach($data->tags as $tag)
                                                <li>{{$tag->tag_name}}</li>
                                            @endforeach
                                          
                                        </ul>
                                    </div>
                                     @if(!$data->image == null)
                                           
                                             <img src="{{asset('storage/idea/'.$data->image)}}" style="width: 100%;border:8px solid #ededed;border-radius: 5px;">
                                            @else
                                           
                                             @endif
                                
                                    <p>{!! str_limit($data->description, 300); !!}
                                    </p>
                                    <a class="read-more-btn" href="{{route('fullIdea',$data->id)}}">Read More</a>
                                </div>
                                <div class="card-footer text-muted">
                                    <div class="like-comment">
                                        <ul>
                                            @auth
                                            @php 
                                                $userId=Auth::user()->id;
                                                $VoteCheck=\App\Vote::where('user_id',$userId)->where('idea_id',$data->id)->first();
                                                
                                            @endphp
                                            @if($VoteCheck==null)
                                           <li><button class="upVote" data-id="{{$data->id}}"><i class="far fa-thumbs-up"></i><span>{{$data->up_vote}}</span></button></li>
                                            <li><button  class="downVote" data-id="{{$data->id}}"><i class="far fa-thumbs-down"></i><span>{{$data->down_vote}}</span></button></li>
                                            <li><button onclick="javascript:location.href='{{route('fullIdea',$data->id)}}'" ><i class="fas fa-comments"></i><span>@if(isset($data->comments)) {{count($data->comments)}} @endif</span></button></li>
                                            @else 

                                            <li><button class="upVote @if($VoteCheck->impression==1) btn-primary @endif"><i class="far fa-thumbs-up"></i><span>{{$data->up_vote}}</span></button></li>
                                            <li><button  class="downVote @if($VoteCheck->impression==0) btn-primary @endif"><i class="far fa-thumbs-down"></i><span>{{$data->down_vote}}</span></button></li>
                                            <li><button onclick="javascript:location.href='{{route('fullIdea',$data->id)}}'" ><i class="fas fa-comments"></i><span>@if(isset($data->comments)) {{count($data->comments)}} @endif</span></button></li>
                                            @endif
                                            @else
                                              <li><button onclick="javascript:location.href='{{route('login')}}'"><i class="far fa-thumbs-up"></i><span>{{$data->up_vote}}</span></button></li>
                                            <li><button onclick="javascript:location.href='{{route('login')}}'"> <i class="far fa-thumbs-down"></i><span>{{$data->down_vote}}</span></button></li>
                                           <li><button onclick="javascript:location.href='{{route('fullIdea',$data->id)}}'" ><i class="fas fa-comments"></i><span>@if(isset($data->comments)) {{count($data->comments)}} @endif</span></button></li>
                                           

                                            @endauth
                                            
                                        </ul>
                                    </div>
                                    <div class="view">
                                        <ul>
                                            <li><i class="far fa-eye"></i> Views <span>{{$data->view}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            </div>
                                              @endforeach
                                              @endif

                                    <div class="post-pagination">
                                    @if(isset($Ideas)){!! $Ideas->render() !!}@endif
                                   
                                    @if(isset($message))
                                    <p>{{ $message }}</p>
                                    @endif

                                    </div>
                </div>

                  <div class="col-md-3">
                    <div class="home-right-bar">
                         <div class="submit_an_idea">
                                    <a href="{{route('submitIdea')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Submit An Idea <i class="fas fa-pen"></i></a>
                                </div>
                                <br>
                                <br>
                        <div class="card">
                            <div class="card-body">

                                <h5>Filter Your Search By</h5>
                                <hr class="hr_reset">
                                <div class="master-search">
                                 
                                        <div class="form-row align-items-center">
                                            <div class="col-md-12 my-1 content" id="custom-scroll">
                                                <select  id="sortBy" class=" form-control float-left">
                                                <option value="Sort By">Sort By</option>
                                                <option value="New">New</option>
                                                <option value="In-Progress">In-Progress</option>
                                                <option value="Completed">Completed</option>
                                                <option value="On-Hold">On-Hold</option>
                                                <option value="Up-Voted">Up-Voted</option>
                                                <option value="Down-Voted">Down-Voted</option>
                                                </select>
                                              
                                            </div>
                                       
                                        </div>
                                    
                                </div>
                                <hr class="hr_reset">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main section end -->

    @push('scripts')
<script type="text/javascript">
    $( document ).ready(function() {
           $('#sortBy').change(function(){
              var value = $(this).val();
              if(value=='Sort By'){
var url='http://localhost:8000/profile';
        window.location.href = url;
              }
              else{
                var url='http://localhost:8000/profile/sortby/'+value;
        window.location.href = url;
              }
              
            });
      });
</script>

@if(isset($query))

<script type="text/javascript">
   $( document ).ready(function() {
               $("#sortBy").val('{{$query}}');
          
      });

</script>

@endif
@endpush
@endsection
