@if(isset($errorName))
    @error($errorName)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
@endif