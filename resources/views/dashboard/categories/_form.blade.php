
<div class="form-group">
    <x-form.input label="Category Image" type="file" name="image" accept="image/*" />
    {{-- <label for="name">Category Image</label>
    <input type="file" name="image" class="form-control" accept="image/"> --}}
    {{-- @if ( $categories->image){
        <<img src="{{ asset("storge/." $categories->image) }}" class="" alt="" height="50">
    }

    @endif --}}
    {{-- @error('image')
    <div class="invalid-feedback">{{ $message }}</div>

    @enderror --}}

</div>

<div class="form-group">

    <x-form.input label="Category Name" name="name" value="{{ $categories->name }}" />
</div>

<div class="form-group">
    <label for="parent_id">Parent Name</label>
    <select name="parent_id" class="form-control">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected($categories->parent_id==$parent->id)>{{ $parent->name }}</option>
        @endforeach



    </select>
</div>

<div class="form-group">
<x-form.textarea label="Category Description" name="description" :value="$categories->description" />
</div>




<div class="form-group">
    <x-form.radio label="Category status" name="status" :checked="$categories->status" :options="['active'=>'Active','archived'=>'Archived']" />
    {{-- <label for="name">Category status</label>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" @checked($categories->status =='active')>
            <label class="form-check-label" for="exampleRadios1">
                active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived" @checked($categories->status=='archived')>
            <label class="form-check-label" for="exampleRadios2">
                archived
            </label>
        </div>
    </div> --}}
</div>


<div class="form-group">

    <button type="submit" class="btn btn-sm btn-outline-primary">{{ $button ?? 'Save' }}</button>
</div>
