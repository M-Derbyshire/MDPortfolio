function toggleExpandButton(arrow, targetID)
{
    let imageElement = arrow.getElementsByTagName('img')[0];
    
    //Make sure the image won't be toggled a 2nd time on a double-click
    if(!document.getElementById(targetID).classList.contains("collapsing"))
    {
        if(imageElement.src.endsWith("expandDropArrow.png"))
        {
            imageElement.src = "/images/collapseRiseArrow.png";
        }
        else
        {
            imageElement.src = "/images/expandDropArrow.png";
        }
    }
}