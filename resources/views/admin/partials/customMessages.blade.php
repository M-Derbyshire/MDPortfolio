@if(Session::get('customErrors') !== null)
    <ul class="customMessageList alert alert-danger">
        @foreach(Session::get('customErrors') as $customError)
            <li role="alert">{{ $customError }}</li>
        @endforeach
    </ul>
@endif

@if(Session::get('customMessages') !== null)
    <ul class="customMessageList alert alert-info">
        @foreach(Session::get('customMessages') as $customMessage)
            <li role="alert">{{ $customMessage }}</li>
        @endforeach
    </ul>
@endif