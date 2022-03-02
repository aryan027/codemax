@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                        <form action="{{route('product.update',[\Illuminate\Support\Facades\Crypt::encrypt($product->id)])}}" method="POST" enctype="multipart/form-data">@csrf
                            {{method_field('PUT')}}
                        <div class="card ">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mt-2">
                                    <label for="">Product Name</label>
                                    <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror " id="" aria-describedby=""
                                           placeholder="Enter name of product" value="{{$product->product_name}}">
                                    @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Product Description</label>
                                    <textarea name="product_description" id="" class="form-control @error('product_description') is-invalid @enderror "> {{$product->product_description}} </textarea>
                                    @error('product_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group mt-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('img_path') is-invalid @enderror  " accept="image/*" id="customFile" name="img_path">

                                        @error('img_path')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                          </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Choose Category</label>
                                    <select name="category_id"  class="form-control @error('category_id') is-invalid @enderror" >
                                        <option value="">select</option>
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{$category->id}}" {{$category->id == $product->category_id  ? 'selected' : ''}} >
                                                {{$category->category_name}}</option>
                                        @endforeach

                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ $product->status== true ? 'checked' : '' }}>

                                        <label class="form-check-label" for="status">
                                            {{ __('Status') }}
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Submit</button>

                            </div>
                        </div>
                    </form>

            </div>
        </div>
    </div>
@endsection
