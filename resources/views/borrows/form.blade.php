@extends('layouts.master')
@section('content')

    <div class="dashboard-content-one">

        <!-- Breadcrumbs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>{{ trans('dashboard.borrows') }}</h3>
            <ul>
                <li>
                    <a href="/">{{ trans('dashboard.home') }}</a>
                </li>
                <li>{{ isset($borrow) ? trans('dashboard.edit_borrow') : trans('dashboard.add_borrow') }}</li>
            </ul>
        </div>
        <!-- Breadcrumbs Area End Here -->

        <div class="card height-auto">
            <div class="card-body">
                <form class="new-added-form" action="{{ isset($borrow) ? route('borrows.update', $borrow->id) : route('borrows.store') }}" method="post">
                    @csrf
                    @if (isset($borrow)) @method('put') @endif
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ trans('dashboard.User') }} <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ isset($borrow) && $borrow->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <p class="text-danger">{{ $errors->first('user_id') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>{{ trans('dashboard.Book') }} <span class="text-danger">*</span></label>
                            <select name="book_id" class="form-control" required>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" {{ isset($borrow) && $borrow->book_id == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('book_id'))
                                <p class="text-danger">{{ $errors->first('book_id') }}</p>
                            @endif
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>{{ trans('dashboard.Borrowed_At') }} <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="borrowed_at" id="borrowed_at" class="form-control" required value="{{ isset($borrow) ? $borrow->borrowed_at->format('Y-m-d\TH:i') : '' }}">
                            @if ($errors->has('borrowed_at'))
                                <p class="text-danger">{{ $errors->first('borrowed_at') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>{{ trans('dashboard.Returned_At') }}</label>
                            <input type="datetime-local" name="returned_at" id="returned_at" class="form-control" value="{{ isset($borrow) ? $borrow->returned_at->format('Y-m-d\TH:i') : '' }}">
                            @if ($errors->has('returned_at'))
                                <p class="text-danger">{{ $errors->first('returned_at') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 form-group mg-t-8 mt-4">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                            {{ isset($borrow) ? trans('dashboard.update') : trans('dashboard.save') }}
                        </button>
                    </div>
                </form>
            </div>
@endsection

@section('script')
    <script>
        // Disable unavailable dates for the selected book
        $('#book_id').on('change', function() {
            const bookId = $(this).val();
            $.ajax({
                url: '/borrows/check-availability/' + bookId,
                method: 'GET',
                success: function(data) {
                    if (data.unavailable_dates) {
                        $('#borrowed_at').attr('min', data.available_from);
                        $('#borrowed_at').attr('max', data.available_until);
                    }
                }
            });
        });
    </script>
@endsection
