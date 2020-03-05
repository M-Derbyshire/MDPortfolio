@if(isset($deleteURL) && isset($id))
    <form id="deleteRecordForm" action="{{ $deleteURL }}" method="post">
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endif