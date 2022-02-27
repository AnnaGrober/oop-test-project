@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Admin') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($admin)
                            <a href="{{ route('user_create') }}"> Добавить юзера </a> <br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">roles</th>
            </tr>
            </thead>
            <tbody>
            {!! Form::open(['url' => '/admin/user/delete', 'class' => 'form-horizontal', 'id' =>'delete_user_value']) !!}
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td> {{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>@foreach ($user->roles as $role)
                            {{$role->name.' '}}
                        @endforeach</td>
                    <td>
                        @if ($admin) {!! Form::submit($user->id, ['class' => 'btn btn-xs btn-danger','value' => $user->id,'id' => $user->id] ) !!} @endif
                        {!! Form::submit($user->id, ['class' => 'btn btn-xs btn-info','value' => $user->id,'id' => $user->id] ) !!}
                        @if ($organizer) {!! Form::submit($user->id, ['class' => 'btn btn-xs btn-success','value' => $user->id,'id' => $user->id] ) !!} @endif
                    </td>
                </tr>
            @endforeach
            {!! Form::close()  !!}
            </tbody>
        </table>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.btn-danger').click(function(e) {
            e.preventDefault();
            var id = $(this).val();

            $.ajax({
                url:     '/admin/user/delete/',
                type:    'POST',
                data:    {
                    "_token":       "{{csrf_token()}}",
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                    'id':           id,
                },
                success: function(response) {
                    $("#success").html(response.message)
                },
            });
        });
        $('.btn-success').click(function(e) {
            e.preventDefault();
            var id = $(this).val();

            $.ajax({
                url:     '/admin/user/invite/',
                type:    'POST',
                data:    {
                    "_token":       "{{csrf_token()}}",
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                    'id':           id,
                },
                success: function(response) {
                    $("#success").html(response.message)
                },
            });
        });
        $('.btn-info').click(function(e) {
            e.preventDefault();
            var id = $(this).val();

            $.ajax({
                url:     '/admin/user/block/',
                type:    'POST',
                data:    {
                    "_token":       "{{csrf_token()}}",
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                    'id':           id,
                },
                success: function(response) {
                    $("#success").html(response.message)
                },
            });
        });
    });
</script>
