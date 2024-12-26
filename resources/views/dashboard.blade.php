@extends('layouts.master')
@section('content')
            <div class="dashboard-content-one" style="height: 1200px">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>{{trans('dashboard.dashboard')}}</h3>
                    <ul>
                        <li>
                            <a href="/">{{trans('dashboard.home')}}</a>
                        </li>
                        <li>{{trans('dashboard.dashboard')}}</li>
                    </ul>
                </div>
                <!-- Dashboard summery Start Here -->
                <div class="row gutters-20">
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <img src="{{asset('users.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">{{trans('dashboard.Users')}}</div>
                                        <div class="item-number"><span class="counter" data-num="150000">{{$users}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">

                                        <img src="{{asset('books.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">{{trans('dashboard.books')}}</div>
                                        <div class="item-number"><span class="counter" data-num="5690">{{$books}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-yellow">
                                        <img src="{{asset('borrows.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">{{trans('dashboard.borrows')}}</div>
                                        <div class="item-number"><span class="counter" data-num="5690">{{$borrows}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard summery End Here -->

@endsection
