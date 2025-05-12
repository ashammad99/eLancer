<select name="country" id="country" class="selectpicker with-border" data-live-search="true" data-size="7" title="Select Job Type">
    @foreach($countries as $code => $name)
        <option value="{{$code}}" @if($code == $selected) selected @endif>
            {{$name}}
        </option>
    @endforeach
</select>
