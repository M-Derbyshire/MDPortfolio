@if(isset($customErrors))
    <ul id="customErrorList" class="alert alert-danger">
        @foreach($customErrors as $customError)
            <li role="alert">{{ $customError }}</li>
        @endforeach
    </ul>
@endif