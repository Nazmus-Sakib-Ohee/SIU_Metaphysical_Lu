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
                                    <h4><strong>Add New User</strong></h4>
                                </div>
                                <div class="card-block">
                                    <div class="j-wrapper j-wrapper">
                                  {!! Form::model($data,['route' => ['users.edit',$data->id], 'method' => 'POST', 'files' => true,'class' => 'j-pro','id' => 'j-pro'])!!}

                                          

                                            <div class="j-content">

                                                <div class="j-unit">
                                                {!! Form::label('name', "User Name",['class'=>'j-label']) !!}
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="name">
                                                            <i class="fa fa-user"></i>
                                                        </label>
                                                        {!! Form::text('name', null, ['class' => 'form-control form-control-success','placeholder' => "User Name",'min' => '0','required' => '1']) !!}
                                                            @if(count($errors)>0)
                                                                @if($errors->has('name'))
                                                                    <small class="form-text-error">  {{$errors->first('name')}}</small>
                                                                @endif
                                                            @endif
                                                    
                                                    </div>
                                                </div>

                                                <div class="j-unit">
                                                {!! Form::label('email', "User Email",['class'=>'j-label']) !!}
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="email">
                                                            <i class="icofont icofont-envelope"></i>
                                                        </label>
                                                        {!! Form::email('email', null, ['class' => 'form-control form-control-success','placeholder' => "User Email",'min' => '0','required' => '1']) !!}
                                                            @if(count($errors)>0)
                                                                @if($errors->has('email'))
                                                                    <small class="form-text-error">  {{$errors->first('email')}}</small>
                                                                @endif
                                                            @endif
                                                    
                                                    </div>
                                                </div>

                                                <div class="j-unit">
                                                {!! Form::label('password', "User Password",['class'=>'j-label']) !!}
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="password">
                                                            <i class="icofont icofont-lock"></i>
                                                        </label>
                                                        {!! Form::password('password', null, ['class' => 'form-control form-control-success','placeholder' => "User Password",'min' => '0','required' => '1']) !!}
                                                         <small style="color: green">Leave blank to remain same</small>
                                                            @if(count($errors)>0)
                                                                @if($errors->has('password'))
                                                                    <small class="form-text-error">  {{$errors->first('password')}}</small>
                                                                @endif
                                                            @endif
                                                    
                                                    </div>
                                                </div>

                                                <div class="j-unit">
                                                {!! Form::label('password_confirmation', "User Password Confirmation",['class'=>'j-label']) !!}
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="password_confirmation">
                                                            <i class="icofont icofont-lock"></i>
                                                        </label>
                                                        {!! Form::password('password_confirmation', null, ['class' => 'form-control form-control-success','placeholder' => "User Password Confirmation",'min' => '0','required' => '1']) !!}
                                                        <small style="color: green">Leave blank to remain same</small>
                                                            @if(count($errors)>0)
                                                                @if($errors->has('password_confirmation'))
                                                                    <small class="form-text-error">  {{$errors->first('password_confirmation')}}</small>
                                                                @endif
                                                            @endif
                                                    
                                                    </div>
                                                </div>
                                                <div class="j-unit">
                                               
                                                {!! Form::label('role', "User Role",['class'=>'j-input']) !!}
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="name">
                                                        <i class="fas fa-sort-down"></i>
                                                        </label>
                                                        {!! Form::select('role',$roles,$UserRole->id, ['class' => '','placeholder' => "Select", 'style'=>'width: 100%;','tabindex'=>'-1','aria-hidden'=>'true','required' => '1'])!!}
                                                        @if(count($errors)>0)
                                                            @if($errors->has('role'))
                                                                <small class="form-text-error">  {{$errors->first('role')}}</small>
                                                            @endif
                                                        @endif
                                                    
                                                    </div>
                                                  
                                                </div>

                                            </div>
                                            </div>

                                            <div class="j-footer">
                                            {!! Form::submit('Save',['class'=>'btn btn-primary float-right']) !!}
                                            
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



</script>
@endpush

