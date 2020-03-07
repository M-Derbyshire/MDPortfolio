<div class="inputContainer">
    <label for="{{ $inputName }}">{{ $inputLabel }}</label>
    {!! $inputField !!}
    
    @php
        if(!isset($inputErrorName))
        {
            $inputErrorName = "";
        }
    @endphp
    
    @include('admin.partials.inputError', ['errorName' => $inputErrorName])
</div>