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
                    <div class="card-header">{{ __('List Category') }}</div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <td>S.no</td>
                                <td>Category Name</td>
                                <td>Parent Category</td>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $key=>$category)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->category_parent }}</td>
                                    <td>@if($category->status==true)Active @else Inactive @endif</td>
                                    <td>
                                        <a href="{{ route('category.edit',\Illuminate\Support\Facades\Crypt::encrypt($category->id)) }}" class="btn btn-info text-white"> Edit</a>

                                    </td>
                                    <td>
                                        <form action="{{route('category.destroy',\Illuminate\Support\Facades\Crypt::encrypt($category->id))}}" method="POST" onsubmit="return confirmDelete()">@csrf
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
