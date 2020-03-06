<label for="selectedLogoID">Select a Logo:</label>
<div id="logoSelector">
    @if(isset($logos) && count($logos) > 0)
        @for($i = 0; $i < count($logos); $i++)
            
            @php 
                $logo = $logos[$i]; 
            @endphp
            
            <img 
                class="img-fluid {{ ($i == 0) ? 'selectedLogo' : '' }}" 
                id="logoID:{{ $logo['id'] }}" 
                src="{{ $logo['url'] }}" 
                alt="Logo: {{ $logo['name'] }}" 
                onClick="onLogoClick({{ $logo['id'] }})" 
            />
        @endfor
        <input type="hidden" id="selectedLogoID" name="selectedLogoID" value="{{ $logos[0]['id'] }}" /> <!-- Is changed by the below script -->
    @else
        <p>There are currently no logos stored in the database.</p>
    @endif
</div>
@include('admin.partials.inputError', ['errorName' => 'logoError'])

<script src="{{ asset('js/logoSelectorScript.js') }}"></script>