@extends('layouts.master')
@section('content')
    <div class="dashboard-content-one">
        <div class="breadcrumbs-area">
            <h3>{{ isset($role) ? trans('dashboard.edit_role') : trans('dashboard.add_role') }}</h3>
            <ul>
                <li><a href="/">{{ trans('dashboard.home') }}</a></li>
                <li>{{ isset($role) ? trans('dashboard.edit_role') : trans('dashboard.add_role') }}</li>
            </ul>
        </div>

        <div class="card height-auto">
            <div class="card-body">
                <form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
                    @csrf
                    @if (isset($role)) @method('put') @endif
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ trans('dashboard.role_name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name ?? '' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label>{{ trans('dashboard.permissions') }}</label>
                            <div>
                                @foreach ($permissions as $permission)
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ isset($role) && $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        {{ $permission->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                        {{ isset($role) ? trans('dashboard.update') : trans('dashboard.save') }}
                    </button>
                </form>
            </div>
        </div>
@endsection
