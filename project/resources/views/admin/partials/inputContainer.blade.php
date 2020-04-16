<div class="inputContainer">
    <label for="{{ $inputName }}">{{ $inputLabel }}</label>
    {!! $inputField !!}
    
    @include('admin.partials.inputError', ['errorName' => $inputName])
</div>