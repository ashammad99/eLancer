@extends('layouts.dashboard')

@section('name_page')
    Show All Categories
    {{-- <small><a href="/categories/create" class="btn btn-sm btn-outline-primary">Create</a></small> --}}
    {{-- using route name--}}
    <small><a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary">Create</a></small>
@endsection

@section('breadcrump')
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')
    <x-flash-message/>
    <div class="table-responsive">
        <table border="1" class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Parent Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id }}</td>
                    <td><a href="{{route('dashboard.categories.show',['category'=>$category->id])}}">{{ $category->name }}</a>
                    </td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->parent_name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td><a href="{{route('dashboard.categories.edit',['category'=>$category->id])}}" class="btn btn-sm btn-dark">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('dashboard.categories.destroy',['category'=>$category->id])}}" method="post">
                            @csrf {{-- csrf_field()--}}
                            @method('delete')
                            <!--input type="hidden" name="_method" value="delete"-->
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{--
    withQueryString: keep current Query String(URL) when paginate pages
    appends: addd Parameters to the current Query String
    links: add paremters page=x and paginate
    --}}
    {{ $categories->withQueryString()->appends(['test'=>'AA'])->links('vendor.pagination.bootstrap-4')}}

@endsection

