@props([
'id','label','name','selected' => '', 'options' => []
])

@if(isset($label))
    {{-- Replace value of label tag with generic variable--}}
    <label for="{{$id}}">{{$label}}</label>
@endif

<select
    id="{{$id}}"
    name="{{$name}}"
    {{$attributes->class(['form-control','is-invalid' => $errors->has($name)])}}
    {{$attributes}}>
    <option value=""></option>
    @foreach($options as $value => $text )
        <option value="{{$value}}" @if($value === old($name, $selected)) selected @endif>{{$text}}</option>
    @endforeach
</select>
@error($name)
<p class="text-danger alert-danger">{{$message}}</p>
@enderror
