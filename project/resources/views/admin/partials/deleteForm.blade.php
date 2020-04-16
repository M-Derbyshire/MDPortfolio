@if(isset($deleteURL) && isset($id))
    <form 
        id="deleteRecordForm" 
        action="{{ $deleteURL }}" 
        method="post"
        onSubmit="return confirm('This operation cannot be undone. Are you sure you would like to proceed with this deletion?');" 
    >
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endif