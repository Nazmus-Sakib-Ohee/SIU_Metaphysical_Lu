
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
                                    <h4><strong>Edit Role</strong></h4>
                                </div>
                                <div class="card-block">
                                    <div class="j-wrapper j-wrapper">
                                    {!! Form::model($data,['route' => ['roles.update',$data->id], 'method' => 'POST', 'files' => true,'class' => 'j-pro','id' => 'j-pro'])!!}

                                            <div class="j-content">

                                                <div class="j-unit">
                                                {!! Form::label('role', "Role Name",['class'=>'j-label']) !!}
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="role">
                                                            <i class="fas fa-recycle"></i>
                                                        </label>
                                                        {!! Form::text('role', null, ['class' => 'form-control form-control-success','placeholder' => "Role Name",'min' => '0','required' => '1']) !!}
                                                            @if(count($errors)>0)
                                                                @if($errors->has('role'))
                                                                    <small class="form-text-error">  {{$errors->first('role')}}</small>
                                                                @endif
                                                            @endif
                                                    
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="j-footer">
                                            {!! Form::submit('Update',['class'=>'btn btn-primary float-right']) !!}
                                            
                                            </div>

                                            {!! Form::close() !!}
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


@endpush



