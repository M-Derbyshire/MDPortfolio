@if(Session::get('customErrors') !== null)
    <ul id="customErrorList" class="alert alert-danger">
        @foreach(Session::get('customErrors') as $customError)
            <li role="alert">{{ $customError }}</li>
        @endforeach
    </ul>
@endif