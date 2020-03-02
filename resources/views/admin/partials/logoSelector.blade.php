<label for="selectedLogoID">Select a Logo:</label>
<div id="logoSelector">
    @if(isset($logos) && count($logos) > 0)
        @foreach($logos as $logo)
            <img 
                class="img-fluid" 
                id="logoID:{{ $logo['id'] }}" 
                src="{{ $logo['url'] }}" 
                alt="Logo: {{ $logo['name'] }}" 
                onClick="onLogoClick({{ $logo['id'] }})" 
            />
        @endforeach
        <input type="hidden" id="selectedLogoID" name="selectedLogoID" value="" /> <!-- Is set by the below script -->
    @else
        <p>There are currently no logos stored in the database.</p>
    @endif
</div>
@include('admin.partials.inputError', ['errorName' => 'logoError'])

<script src="{{ asset('js/logoSelectorScript.js') }}"></script>