@extends('layouts.dashboard')

@section('page-title')
    Categories
    {{-- @if (Auth::user()->can('categories.create')) --}}
    @can('create', App\Models\Category::class)
        <small><a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Create</a></small>
    @endcan
@endsection

@section('content')

    <x-flash-message/>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Parent ID</th>
                <th>Created At</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        <a href="{{ route('categories.show', ['category' => $category->id]) }}">{{ $category->name }}</a>
                    </td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->parent_name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('categories.edit', [$category->id]) }}"
                           class="btn btn-sm btn-dark">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
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

