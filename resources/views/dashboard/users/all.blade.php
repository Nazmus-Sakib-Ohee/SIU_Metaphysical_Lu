
@extends('dashboard/dash_inc.adjust')
@section('content')

<br>
<br>

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
	                                    <th data-field="Email" data-sortable="false">Email</th>
	                                    <th data-field="Action" data-sortable="false">Action</th>
	                                </tr>
	                                </thead>
                                  <tbody>
                                    @if(isset($TableData))
                                    @foreach($TableData as $item)
                                    <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td class="text-center">
                                    <a href="{{route('users.edit',$item->id)}}" style="color: #fff;" class=" btn  btn-info"
                                    >
                                    <span class="fas fa-edit"></span>
                                    </a> 
                                     <a style="color: #fff;" class="DeleteContent btn btn-warning waves-effect"
                                            data-id="{{$item->id}}" data-name="{{$item->name}}" data-pic="{{$item->image}}"data-url="{{route('users.delete')}}" >
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
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td class="text-center">
                                    <a href="{{route('users.edit',$item->id)}}" style="color: #fff;" class=" btn  btn-info"
                                    >
                                    <span class="fas fa-edit"></span>
                                    </a>  
                                    <a style="color: #fff;" class="DeleteContent btn btn-danger btn-info"
                                    data-id="{{$item->id}}" data-name="{{$item->name}}" data-pic="{{$item->image}}"data-url="{{route('users.delete')}}" >
                                    <span class="fas fa-trash-alt"></span>
                                    </a>
                                      <a style="color: #fff;" class="DeleteContent btn btn-warning waves-effect"
                                            data-id="{{$item->id}}" data-name="{{$item->name}}" data-pic="{{$item->image}}"data-url="{{route('users.delete')}}" >
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

@endsection


@push('custom-scripts')

<script type="text/javascript">
    $( document ).ready(function() {
 $('.fixed-table-toolbar').append(`{!! Form::open(['route' => 'users.search','method'=>'GET','class' => 'float-left','style' => 'width: calc(100% - 155px);margin-top: 13px;'])!!}

{!! Form::text('query', null, ['class' => 'form-control form-control-success','placeholder' => "Search query",'min' => '0','required' => '1']) !!}
   {!! Form::close() !!}`);
});

</script>

@endpush

