<div class="form-group">
{{--if the value variable its has calculated value set colon before the value attribute :value='$category->name' --}}
    <x-form.input class="form-control-lg" type="text" id="name" name="name" label="Category Name" value='{{$category->name}}' />
</div>
<div class="form-group">
    <label for="desc">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="desc" name="description">{{old('description',$category->description)}}</textarea>
    @error('description')
        <p class="text-danger alert-danger">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    <x-form.select class="form-control-lg" id="parent_id" name="parent_id" label="Parent" :options="$parents->pluck('name','id')" :selected="$category->parent_id"/>
</div>
<div class="form-group">
    <x-form.input  class="form-control-lg" type="file" id="art_file" name="art_file" label="Category Art File" :value='$category->art_file' />
</div>


<div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
</div>
