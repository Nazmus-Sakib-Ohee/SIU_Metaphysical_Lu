
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
	                          <table id="table4" data-toolbar="#toolbar" data-search="true" data-show-refresh="false"
                                       data-show-toggle="true" data-show-columns="true" data-show-export="false"
                                       data-detail-view="true" data-detail-formatter="detailFormatter"
                                       data-minimum-count-columns="0" data-show-pagination-switch="false"
                                       data-pagination="false" data-id-field="id" data-page-list="[10, 20,40]"
                                      >
	                                <thead>
	                                <tr>
	                                    <th data-field="User Name" data-sortable="false">User Name</th>
	                                    <th data-field="Total Votes" data-sortable="false">Total Votes</th>
	                                   
	                                </tr>
	                                </thead>
                                  <tbody>
                                    @if(isset($TableData))

                                    @foreach($TableData as $item)
                                    <tr>
                                    <td>{{$item['name']}}</td>
                                    <td>{{$item['vote']}}</td>
                                 

                                    </tr>
                                    @endforeach
                                    @endif
                                    
                                  </tbody>
	                            </table>
                                 <br>
                           
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



@endpush

