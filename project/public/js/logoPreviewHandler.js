//Using ES5 class for compatibility

//When a new logo is uploaded (on the logo's edit view), update the image preview.
function LogoPreviewHandler(imageElement, fileInputField)
{
    this.imageElement = imageElement;
    this.fileInputField = fileInputField;
    
    this.initialUrl = imageElement.src;
}

LogoPreviewHandler.prototype.fileUploaded = function() {
    if(this.fileInputField.files.length > 0)
    {
        let file = this.fileInputField.files[0];
        
        //If the file type is "image/gif", "image/jpeg", etc
        if(file['type'].split('/')[0] === 'image')
        {
            this.imageElement.src = URL.createObjectURL(file);
        }
        else
        {
            //Not an image file
            alert("The uploaded file is not a valid image file.");
            this.resetImage();
        }
    }
    else
    {
        //No file chosen
        this.resetImage();
    }
    
    this.updateImageDisplayStyle();
}

LogoPreviewHandler.prototype.resetImage = function() {
    this.imageElement.src = this.initialUrl;
};

//Will check if the img element needs to be displayed, then correct as needed
LogoPreviewHandler.prototype.updateImageDisplayStyle = function() {
    //img elements will have the page url as their src, if set to empty string.
    if(!this.imageElement.src || this.imageElement.src == "" || this.imageElement.src === window.location.href)
    {
        this.imageElement.style.display = "none";
    }
    else
    {
        this.imageElement.style.display = "block";
    }
};

logoPreviewHandler = new LogoPreviewHandler(
    document.getElementById("logoUploadPreview"), 
    document.getElementById("fileInput")
);

logoPreviewHandler.fileInputField.addEventListener("change", function() { logoPreviewHandler.fileUploaded(); });