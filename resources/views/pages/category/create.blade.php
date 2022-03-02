@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Category') }} </div>
                    <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">@csrf

                    <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Category Name</label>
                                        <input type="text" name="category_name" value="{{ old('category_name') }}" class="form-control @error('category_name') is-invalid @enderror " id="" aria-describedby=""
                                               placeholder="Enter name of category">
                                        @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="">Parent Category</label>
                                        <input name="category_parent" value="{{ old('category_parent') }}" class="form-control @error('category_parent') is-invalid @enderror ">
                                        @error('category_parent')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                <div class="form-group mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="status" id="status" {{ old('status') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="status">
                                            {{ __('Status') }}
                                        </label>
                                    </div>
                                </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
