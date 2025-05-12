
{{--    if you call the compnenet and add a new attributes to component,--}}
{{--    the laravel handle it as variables in the component,--}}
{{--    but you need to define specific variables, use directive @props, properties--}}
{{--    in sometime when calling the components you need to add a new attributes not defined in props,--}}
{{--    use attributes variable after the defined attributes, without props its will replicate the variable.--}}

{{----}}
{{--@props([--}}
{{--    'id','label','name','value','type'--}}
{{--])--}}

{{-- in some forms, replacing label with headings --}}
{{--@if(isset($label))--}}
{{--    --}}{{-- Replace value of label tag with generic variable--}}
{{--    <label for="{{$id}}">{{$label}}</label>--}}
{{--@endif--}}

{{-- in old remove $category->field, and add general varaibale $valu, to pass it when calling the component--}}
{{--    as html attribute <x-input value=''/>--}}
{{----}}
{{--<input--}}
{{--    type="{{$type ?? 'text'}}" --}}{{-- giving default value for type --}}
{{--    id="{{$id}}"--}}
{{--    name="{{$name}}"--}}
{{--    value="{{old($name,$value)}}"--}}
{{--    --}}{{-- What oif you need to append a new classes to predefined classes?--}}
{{--    --}}
{{--    {{$attributes->class(['form-control','is-invalid' => $errors->has($name)])}}--}}
{{--    {{$attributes}}--}}
{{-->--}}
{{--@error($name)--}}
{{--<p class="text-danger alert-danger">{{$message}}</p>--}}
{{--@enderror--}}


@props([
'id' => '', 'label', 'name', 'value' => '', 'type' => 'text'
])

@if (isset($label))
    <label for="{{ $id }}">{{ $label }}</label>
@endif
<input
    type="{{ $type }}"
    id="{{ $id }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
>
@error($name)
<p class="invalid-feedback">{{ $message }}</p>
@enderror
