
@extends('dashboard/dash_inc.adjust')
@section('content')

<br>
<br>
@csrf

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
               
            <div class="page-body">
                    <div class="row">
                    <div class="col-lg-12">
	                    <div class="card filterable">
	                     
                      <div class="card-body">
	                          <table id="table4" data-toolbar="#toolbar" data-search="false" data-show-refresh="false"
                                       data-show-toggle="true" data-show-columns="true" data-show-export="false"
                                       data-detail-view="true" data-detail-formatter="detailFormatter"
                                       data-minimum-count-columns="0" data-show-pagination-switch="false"
                                       data-pagination="false" data-id-field="id" data-page-list="[10, 20,40]"
                                      >
	                                <thead>
	                                <tr>
	                                    <th data-field="User Name" data-sortable="false">User Name</th>
	                                    <th data-field="Email" data-sortable="false">Title</th>
                                      <th data-field="Image" data-sortable="false">Image</th>
                                      <th data-field="Up Votes" data-sortable="false">Up Votes</th>
                                      <th data-field="Down Votes" data-sortable="false">Down Votes</th>
	                                    <th data-field="Status" data-sortable="false">Status</th>
                                      <th data-field="Created At" data-sortable="false">Created At</th>
                                      <th data-field="Action" data-sortable="false">Action</th>
	                                </tr>
	                                </thead>
                                  <tbody>
                                    @if(isset($TableData))
                                    @foreach($TableData as $item)
                                    <tr>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->title}}</td>
                                    @if($item->image== null)
                                    <td></td>
                                    @else
                                    <td>
                                    <img src="{{url('/storage/idea/'.$item->image)}}" height="50" width="50"></td>
                                    @endif

                                    <td>{{$item->up_vote}}</td>
                                    <td>{{$item->down_vote}}</td>
                                    <td><h6 style="color: green;font-weight: bold; text-align: center;">{{"( ".$item->status." )"}}</h6>
                                  <button class="btn btnChangeStatus btn-warning waves-effect text-center" data-target="#Modal-tab" data-toggle="modal" data-id="{{$item->id}}" data-status="{{$item->status}}" style="padding: 7px 12px;line-height: 4px;font-size: 10px;">Change</button>
                                    </td>
                               @php
                               $date = \Carbon\Carbon::parse($item->created_at, 'UTC');
                               @endphp
                                    <td>

                                      <p>{{$date->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</p>
                                </td>
                                    <td class="text-center">
                                    <a href="{{route('idea.view',$item->id)}}" style="color: #fff;" class=" btn  btn-info"
                                    >
                                    <span class="fas fa-info"></span>
                                    </a>
                                      <a style="color: #fff;" class="DeleteContent btn btn-danger btn-info"
                                      data-id="{{$item->id}}" data-name="{{$item->title}}" data-pic="{{$item->image}}"data-url="{{route('idea.delete')}}" >
                                      <span class="fas fa-trash-alt"></span>
                                      </a> 
                                 
                                    
                                    </td>

                                    </tr>
                                    @endforeach
                                    @endif
                                    @if(isset($details))
                                    <p style="font-size: 20px;"> The Search results for your query <b> {{ $query }} </b> are :</p>
                                  
                                     @foreach($details as $item)
                                       <tr>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->title}}</td>
                                    @if($item->image== null)
                                    <td></td>
                                    @else
                                    <td>
                                    <img src="{{url('/storage/idea/'.$item->image)}}" height="50" width="50"></td>
                                    @endif

                                    <td>{{$item->up_vote}}</td>
                                    <td>{{$item->down_vote}}</td>
                                    <td><h6 style="color: green;font-weight: bold; text-align: center;">{{"( ".$item->status." )"}}</h6>
                                  <button class="btn btnChangeStatus btn-warning waves-effect text-center" data-target="#Modal-tab" data-toggle="modal" data-id="{{$item->id}}" data-status="{{$item->status}}" style="padding: 7px 12px;line-height: 4px;font-size: 10px;">Change</button>
                                    </td>
                               @php
                               $date = \Carbon\Carbon::parse($item->created_at, 'UTC');
                               @endphp
                                    <td>

                                      <p>{{$date->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</p>
                                </td>
                                    <td class="text-center">
                                    <a href="{{route('idea.view',$item->id)}}" style="color: #fff;" class=" btn  btn-info"
                                    >
                                    <span class="fas fa-info"></span>
                                    </a>
                                      <a style="color: #fff;" class="DeleteContent btn btn-danger btn-info"
                                      data-id="{{$item->id}}" data-name="{{$item->title}}" data-pic="{{$item->image}}"data-url="{{route('idea.delete')}}" >
                                      <span class="fas fa-trash-alt"></span>
                                      </a> 
                           
                                    
                                    </td>

                                    </tr>
                                     @endforeach
                                    @endif
                                  </tbody>
	                            </table>
                                 <br>
                            @if(isset($TableData)){!! $TableData->render() !!}@endif
                                @if(isset($details)){!! $details->render() !!}
                                @elseif(isset($message))
                                <p>{{ $message }}</p>
                                @endif
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


<div class="modal fade modal-flex" id="Modal-tab" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-body">


<div class="tab-content modal-body">

     <div class="card-block">
                                    <div class="j-wrapper j-wrapper">
                                    {!! Form::open(['route' => 'idea.status','files' => true,'class' => 'j-pro','id' => 'j-pro'])!!}

                                            <div class="j-content">
                                   
                                                <div class="j-unit">
                                               
                                                {!! Form::label('item_status', "Item Status",['class'=>'j-input']) !!}
                                                <br>
                                                {!! Form::hidden('item_id','') !!}
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="name">
                                                        <i class="fas fa-sort-down"></i>
                                                        </label>
                                                        {!! Form::select('item_status',['New'=>'New','In-Progress'=>'In-Progress','Completed'=>'Completed','On-Hold'=>'On-Hold'],null, ['class' => '','placeholder' => "Select", 'style'=>'width: 100%;','tabindex'=>'-1','aria-hidden'=>'true','required' => '1'])!!}
                                                        @if(count($errors)>0)
                                                            @if($errors->has('item_status'))
                                                                <small class="form-text-error">  {{$errors->first('item_status')}}</small>
                                                            @endif
                                                        @endif
                                                    
                                                    </div>
                                                  
                                                </div>

                                            </div>

                                            <div class="j-footer">
                                            {!! Form::submit('Update Status',['class'=>'btn btn-primary float-right']) !!}
                                            
                                            </div>

                                            {!! Form::close() !!}
                                    </div>
                                </div>
</div>
</div>
</div>
</div>
</div>

@endsection


@push('custom-scripts')

<script type="text/javascript">
      $( document ).ready(function() {
 $('.btnChangeStatus').click(function() { 
   
          var item_id=$(this).data('id');
          var item_status=$(this).data('status');
       
          $("#item_status").val(item_status);
          $("input[name='item_id']").val(item_id);

     }); 

 });

</script>

<script type="text/javascript">
    $( document ).ready(function() {
 $('.fixed-table-toolbar').append(`{!! Form::open(['route' => 'idea.search','method'=>'GET','class' => 'float-right','style' => 'width: calc(50% - 155px);margin-top: 13px;'])!!}

{!! Form::text('query', null, ['class' => 'form-control form-control-success','placeholder' => "Search query",'min' => '0','required' => '1']) !!}
   {!! Form::close() !!} <select style="width:312px;margin-top: 13px;"  id="sortBy" class=" form-control float-left">
<option value="Sort By">Sort By</option>
<option value="New">New</option>
<option value="In-Progress">In-Progress</option>
<option value="Completed">Completed</option>
<option value="On-Hold">On-Hold</option>
<option value="Up-Voted">Up-Voted</option>
<option value="Down-Voted">Down-Voted</option>
</select>`);
});

</script>

<script type="text/javascript">
    $( document ).ready(function() {
           $('#sortBy').change(function(){
              var value = $(this).val();
              if(value=='Sort By'){
var url='http://localhost:8000/dashboard/idea/all';
        window.location.href = url;
              }
              else{
                var url='http://localhost:8000/dashboard/idea/sortby/'+value;
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

