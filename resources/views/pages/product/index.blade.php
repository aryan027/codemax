@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('List Product') }}</div>
                   <div class="card-body">
                       <table class="table table-striped table-bordered table-hover">
                           <thead>
                           <tr>
                               <td>S.no</td>
                               <td>Product Name</td>
                               <td>Product Description</td>
                               <td>Category</td>
                               <td>Status</td>
                               <td></td>
                           </tr>
                           </thead>
                           <tbody>
                           @forelse($products as $key=>$product)
                               <tr>
                                   <td>{{ $key+1 }}</td>
                                   <td>{{ $product->product_name }}</td>
                                   <td>{{ $product->product_description }}</td>
                                   <td>{{ $product->category_id }}</td>
                                   <td>@if($product->status==true)Active @else Inactive @endif</td>
                                   <td>
                                       <a href="{{ route('product.edit',\Illuminate\Support\Facades\Crypt::encrypt($product->id)) }}" class="btn btn-info text-white"> Edit</a>

                                   </td>
                                   <td>
                                       <form action="{{route('product.destroy',[\Illuminate\Support\Facades\Crypt::encrypt($product->id)])}}" method="POST" onsubmit="return confirmDelete()">@csrf
                                           {{method_field('DELETE')}}
                                           <button type="submit" class="btn btn-sm btn-danger" >Delete</button>

                                       </form>
                                   </td>
                               </tr>
                           @empty
                               <tr>
                                   <td colspan="6" class="text-danger text-center">No record found  !!</td>
                               </tr>
                           @endforelse
                           </tbody>
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
