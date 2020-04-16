//The script for selecting a logo in the logo selector
onLogoClick = (id) => {
    selectedLogoField = document.getElementById('selectedLogoID');
    
    currentlySelectedLogo = document.getElementById('logoID:' + selectedLogoField.value);
    if(typeof(currentlySelectedLogo) != 'undefined' && currentlySelectedLogo != null)
    {
        currentlySelectedLogo.classList.remove('selectedLogo');
    }
    
    newlySelectedLogo = document.getElementById('logoID:' + id);
    newlySelectedLogo.classList.add('selectedLogo');
    
    selectedLogoField.value = id;
};