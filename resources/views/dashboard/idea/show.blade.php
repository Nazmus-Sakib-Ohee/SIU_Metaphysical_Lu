@extends('dashboard/dash_inc.adjust')
@push('css')
@endpush
@section('content')
<br>
<br>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4><strong>Idea Overview</strong></h4>
                                </div>
                                <div class="card-block">
                                    
                                    <div class="row idea_info">
                                        <div class="col-md-6">
                                            @if($data->image == null)
                                            
                                            
                                            @else
                                             <img src="{{url('/storage/idea/'.$data->image)}}" alt="">
                                             @endif

                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="row">
                                                <div class="col-md-12 idea_txt">
                                                    <br><br><br>
                                                    <p><strong>Proposer Name: &nbsp;</strong> {{$data->user->name}}</p>
                                                    <p><strong>Idea Title: &nbsp;</strong> {{$data->title}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 idea_desc">
                                            <br>
                                            <p><strong>Idea Description</strong></p>
                                            <p>{!! $data->description !!}</p>
                                        </div>
                                        <br>
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
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
</script>
@endpush