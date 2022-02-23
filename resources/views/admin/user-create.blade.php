@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="well">

        {!! Form::open(['url' => '/admin/user/create', 'class' => 'form-horizontal', 'id' =>'create-user-form']) !!}

        <fieldset>
@csrf
            <div class="form-group">
                {!! Form::label('name', 'Name:', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('name', $value = null, ['id' => 'name']) !!}
                </div>
            </div>
            <!-- Email -->
            <div class="form-group">
                {!! Form::label('email', 'Email:', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::email('email', $value = null, ['class' => 'form-control', 'id' => 'email']) !!}
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                {!! Form::label('password', 'Password:', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::password('password',['class' => 'form-control', 'id' => 'password', 'type' => 'password']) !!}

                </div>
            </div>

            <div class="checkbox">
                {!! Form::label('organizer', 'Организатор') !!}
                {!! Form::checkbox('organizer', null, array('id'=>'organizer')) !!}
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right', 'id' => 'create-user-btn'] ) !!}
                </div>
            </div>

        </fieldset>

        {!! Form::close()  !!}

    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
    $('#create-user-btn').click( function(e){
        e.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var organizer= $("#organizer").is(':checked');

        $.ajax({
            type: 'POST',
            data:{
                "_token" : "{{csrf_token()}}",
                'X-CSRF-TOKEN':"{{csrf_token()}}",
                name:name,
                email:email,
                password:password,
                organizer:organizer,

            },
            success:function(response){
                $("#success").html(response.message)
            },
        });
    });
    });
</script>
