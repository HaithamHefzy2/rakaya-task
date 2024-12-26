@extends('layouts.master')
@section('content')

    <div class="dashboard-content-one">

        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>{{trans('dashboard.books')}}</h3>
            <ul>
                <li>
                    <a href="/">{{trans('dashboard.home')}}</a>
                </li>
                <li>{{isset($book) ? trans('dashboard.edit_book') : trans('dashboard.add_book')}}</li>
            </ul>
        </div>
        <!-- Breadcubs Area End Here -->

        <div class="card height-auto">
            <div class="card-body">
                @if(isset($book))
                    <form class="new-added-form" action="{{route('books.update', $book->id)}}" method="post">
                        @csrf
                        @method('put')
                        @else
                            <form class="new-added-form" action="{{route('books.store')}}" method="post">
                                @csrf
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{trans('dashboard.Title')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" value="{{isset($book) ? $book->title : ''}}" placeholder="{{trans('dashboard.enter_title')}}" required>
                                        @if ($errors->has('title'))
                                            <p class="text-danger">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{trans('dashboard.Author')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="author" value="{{isset($book) ? $book->author : ''}}" placeholder="{{trans('dashboard.enter_author')}}" required>
                                        @if ($errors->has('author'))
                                            <p class="text-danger">{{ $errors->first('author') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{trans('dashboard.Availability')}}</label>
                                        <select name="is_available" class="form-control">
                                            <option value="1" {{isset($book) && $book->is_available ? 'selected' : ''}}>{{trans('dashboard.Available')}}</option>
                                            <option value="0" {{isset($book) && !$book->is_available ? 'selected' : ''}}>{{trans('dashboard.Not_Available')}}</option>
                                        </select>
                                        @if ($errors->has('is_available'))
                                            <p class="text-danger">{{ $errors->first('is_available') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 form-group mg-t-8" style="margin-top: 25px">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{trans('dashboard.save')}}</button>
                                </div>
                            </form>
            </div>

@endsection
