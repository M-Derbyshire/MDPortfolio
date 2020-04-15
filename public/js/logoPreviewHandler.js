//Using ES5 class for compatibility

//When a new logo is uploaded (on the logo's edit view), update the image preview.

function LogoPreviewHandler(imageElement, fileInputField)
{
    this.imageElement = imageElement;
    this.initialUrl = imageElement.src;
    
    this.fileInputField = fileInputField;
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
}

LogoPreviewHandler.prototype.resetImage = function() {
    this.imageElement.src = this.initialUrl;
}

logoPreviewHandler = new LogoPreviewHandler(
    document.getElementById("logoUploadPreview"), 
    document.getElementById("fileInput")
);

logoPreviewHandler.fileInputField.addEventListener("change", function() { logoPreviewHandler.fileUploaded(); });