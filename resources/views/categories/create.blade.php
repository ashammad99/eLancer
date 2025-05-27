@extends('layouts.dashboard') {{--this directive specify layout file in the path --}}

{{--    @if($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $message)--}}
{{--            <li>{{ $message}}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    @endif--}}
@section('name_page')
    Create Category {{-- if section dont have any html tags u can pass to section as arg like that @section('name_page','Create Category') --}}
@endsection
@section('breadcrump')
    <li class="breadcrumb-item active">Create Category</li>
@endsection
@section('content')
    <form action="{{route('categories.store')}}" method="post">
        <!--input type="hidden" name="_token" value="<?= csrf_token()?>"-->
{{--                @csrf  csrf_field()--}}
        @csrf
        <!-- div class="form-group">
            <label for="name">Name:</label>
{{--             <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"> --}}
        {{--            @if($errors->has('name'))--}}
        <p class="text-danger">{{$errors->first('name')}}</p>
{{--            @endif--}}
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control"></textarea>
{{--            @error('description')--}}
        {{--            <p class="invalid-feedback">{{$message}}</p>--}}
        {{--            @enderror--}}
        </div>
        <div class="form-group">
            <label for="parent_id">Description:</label>
            <select id="parent_id" name="parent_id" class="form-control">
                <option value="">No Parent</option>
{{--                @foreach ($parents as $parent)--}}
        {{--                    {--}}
        {{--                    "--}}
        {{--                    <option value='$parent->id'>". $parent->name ."</option>}}";--}}
        {{--                @endforeach--}}
        </select>
    </div>
    <div class="form-group">
        <label for="art_file">Art File</label>
        <input type="file" id="art_file" name="art_file" class="form-control">
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Add</button>
    </div-->
        @include('categories._form')
    </form>
@endsection
