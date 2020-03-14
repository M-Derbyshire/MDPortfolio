<label for="selectedLogoID">Select a Logo:</label>
<div id="logoSelector">
    @if(isset($logos) && count($logos) > 0)
        
        @php
            //If the logo is not set, select the first logo.
            $currentLogoId = ($currentLogoId ?? $logos[0]['id'] ?? 0);
        @endphp
        
        @for($i = 0; $i < count($logos); $i++)
            
            @php 
                $logo = $logos[$i]; 
            @endphp
            
            <img 
                class="img-fluid {{ ($logo['id'] == $currentLogoId) ? 'selectedLogo' : '' }}" 
                id="logoID:{{ $logo['id'] }}" 
                src="{{ url('/uploads/logos/'.$logo['url']) }}" 
                alt="Logo: {{ $logo['name'] }}" 
                onClick="onLogoClick({{ $logo['id'] }})" 
            />
        @endfor
    @else
        <p>There are currently no logos stored in the database.</p>
    @endif
</div>
<input type="hidden" id="selectedLogoID" name="selectedLogoID" value="{{ $currentLogoId }}" /> <!-- Is changed by the below script -->
@include('admin.partials.inputError', ['errorName' => 'selectedLogoID'])

<script src="{{ asset('js/logoSelectorScript.js') }}"></script>