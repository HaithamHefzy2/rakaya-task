@extends('layouts.master')
@section('content')

    <div class="dashboard-content-one">
        <div class="breadcrumbs-area">
            <h3>{{ isset($user) ? trans('dashboard.Edit_User') : trans('dashboard.Add_User') }}</h3>
            <ul>
                <li>
                    <a href="/">{{ trans('dashboard.home') }}</a>
                </li>
                <li>{{ isset($user) ? trans('dashboard.Edit_User') : trans('dashboard.Add_User') }}</li>
            </ul>
        </div>

        <div class="card height-auto">
            <div class="card-body">
                @if(isset($user))
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        @else
                            <form action="{{ route('users.store') }}" method="post">
                                @csrf
                                @endif
                                <div class="form-group">
                                    <label>{{ trans('dashboard.Name') }}</label>
                                    <input type="text" name="name" value="{{ isset($user) ? $user->name : '' }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('dashboard.Email') }}</label>
                                    <input type="email" name="email" value="{{ isset($user) ? $user->email : '' }}" class="form-control" required>
                                </div>

                                @if(!isset($user))
                                    <div class="form-group">
                                        <label>{{ trans('dashboard.Password') }}</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                @endif

                                <div class="row col-12 form-group">
                                    <label class="col-sm-4">{{ trans('dashboard.Roles') }}</label>
                                    <div class="col-sm-8">
                                        <select name="roles" class="form-control">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ isset($user) && $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('roles'))
                                            <div class="alert alert-danger">{{ $errors->first('roles') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Create' }}</button>
                            </form>
            </div>
        </div>

@endsection
