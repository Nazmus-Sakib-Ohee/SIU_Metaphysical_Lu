@extends('frontend.layout-master')
@section('content')
@csrf
<!-- main section started -->
<div id="mainBox">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="home-middle-section">
                    <div class="post-section">
                        <div class="card">
                            <div class="card-body">
                                <div class="post-header-area">
                                    <div class="post-profile-img">
                                        <img src="{{asset('frontend/image/Profile_avatar_placeholder_large.png')}}" class="card-img-top" alt="Image">
                                        
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
                                
                                <p>{!!$data->description!!}
                                </p>
                                @if($data->pptx == null)
                                @else
                                <div class="col-md-12 idea_present">
                                    <strong>Idea Presentation</strong>
                                    <br><br>
                                    <iframe src="https://docs.google.com/gview?url=https://www.adobe.com/support/ovation/ts/docs/ovation_test_show.ppt&embedded=true"
                                    style="width: 90%; height: 1000px">
                                    <p>Your browser does not support iframes.</p>
                                    </iframe>
                                </div>
                                @endif
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
                            @auth
                                                            <div class="comment_box">
                                    <div class="inner_comment_box">
                                        <form action="{{route('comment',$data->id)}}" method="post">
                                            @csrf

                                            <textarea name="comment" id="" rows="5" placeholder="Write your comment..." style="width: 97%;margin: 15px;"></textarea>

                                            <button type="submit" class="btn btn-success" style="float:right;margin-right: 15px;">Submit</button>
                                        </form>
                                    </div>
                               
                                </div>
                                @endauth
                                @foreach($data->comments as $comment)
                                     <div class="row" id="postTable"  style="margin:15px">
                                        <div class="col-md-1">
                                           <img src="{{asset('frontend/image/Profile_avatar_placeholder_large.png')}}" alt="profile-image" height="90" width="80">
                                        </div>
                                        <div class="col-md-11">
                                            <p>{{$comment->user->name}}</p>
                                            <p>{{$comment->comment}}</p>
                                            <p>{{$comment->created_at->diffForHumans()}}<p>
                                        </div>
                                    </div>
                                      @endforeach
                        </div>
                    </div>
                </div>
                
                
            </div>
            
        </div>
    </div>
</div>
<!-- main section end -->
<!-- pagination -->
<!-- end  -->
@endsection


@push('scripts')

    


@endpush