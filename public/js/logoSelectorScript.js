//The script for selecting a logo in the logo selector
onLogoClick = (id) => {
    selectedLogoField = document.getElementById('selectedLogoID');
    
    if(selectedLogoField.value !== "")
    {
        currentlySelectedLogo = document.getElementById('logoID:' + selectedLogoField.value);
        currentlySelectedLogo.classList.remove('selectedLogo');
    }
    
    newlySelectedLogo = document.getElementById('logoID:' + id);
    newlySelectedLogo.classList.add('selectedLogo');
    
    selectedLogoField.value = id;
};