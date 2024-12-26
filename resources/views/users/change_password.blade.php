@extends('layouts.master')
@section('content')
    <div class="dashboard-content-one">
        <!-- Breadcrumbs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>{{ trans('dashboard.Users') }}</h3>
            <ul>
                <li>
                    <a href="/">{{ trans('dashboard.home') }}</a>
                </li>
                <li>{{ trans('dashboard.Change password') }}</li>
            </ul>
        </div>
        <!-- Breadcrumbs Area End Here -->

        <!-- Card Area Start Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>{{ trans('dashboard.Change password') }}</h3>
                    </div>
                </div>
                @if(isset($user))
                    <form class="new-added-form" action="{{ route('users.changePassword', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="row col-12 form-group">
                                <label class="col-sm-4">
                                    {{ trans('dashboard.new Password') }} *
                                </label>
                                <div class="col-sm-8">
                                    <input type="password" name="new_password" placeholder=" " class="form-control">
                                    @if($errors->has('new_password'))
                                        <div class="alert alert-danger">{{ $errors->first('new_password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row col-12 form-group">
                                <label class="col-sm-4">
                                    {{ trans('dashboard.Password Confirmation') }} *
                                </label>
                                <div class="col-sm-8">
                                    <input type="password" name="password_confirmation" placeholder=" " class="form-control">
                                    @if($errors->has('password_confirmation'))
                                        <div class="alert alert-danger">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ trans('dashboard.save') }}</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
        <!-- Card Area End Here -->
    </div>
@endsection

@section('script')
    <script>
        @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
        @elseif(Session::has('error'))
        toastr.error("{{ Session::get('error') }}")
        @endif
    </script>
@endsection
