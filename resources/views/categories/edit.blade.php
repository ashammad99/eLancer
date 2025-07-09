@extends('layouts.dashboard')

@section('name_page')
    Edit Category
@endsection
@section('content')
    <form action="{{route('categories.update',['category' =>$category->id])}}" method="post">
        <!--input type="hidden" name="_token" value="{{ csrf_token()}}"-->
                @csrf
        @method('put')
        <!--input type="hidden" name="_method" value="put"-->
        @include('categories._form')
    </form>
@endsection
