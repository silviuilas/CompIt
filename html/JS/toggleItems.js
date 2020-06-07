function toggleMainCheckBox(checkBox){
    if(checkBox.classList.contains("checkBoxOn")) {
        checkBox.classList.remove("checkBoxOn");
        checkBox.classList.add("checkBoxOff");
    }
    else if (checkBox.classList.contains("checkBoxOff")) {
        checkBox.classList.remove("checkBoxOff");
        checkBox.classList.add("checkBoxOn");
    }
}
function toggleItems(site,parentBox){
    checkBox=parentBox.childNodes[1];
    toggleMainCheckBox(checkBox);
    if(site=="Compari")
        toggleCompariItems(checkBox);
    else if(site=="Compara")
        toggleComparaItems(checkBox);
}
function toggleClassesObj(className,action){
    let display;
    if(action==="show"){
        display="";
    }
    else if(action==="hide"){
        display="none";
    }
    else display=action;
    let divs= document.getElementsByClassName(className); //divsToHide is an array
    for(let i = 0; i < divs.length; i++){
        divs[i].style.display = display; // depending on what you're doing
    }
}

function toggleCompariItems(checkBox){
    if(checkBox.classList.contains("checkBoxOn")) {
        toggleClassesObj("compari.ro","show");
        redrawBoxes();
    }
    else if (checkBox.classList.contains("checkBoxOff")) {
        toggleClassesObj("compari.ro","hide");
        redrawBoxes();
    }
}
function toggleComparaItems(checkBox){
    if(checkBox.classList.contains("checkBoxOn")) {
        toggleClassesObj("compara.ro","show");
        redrawBoxes();
    }
    else if (checkBox.classList.contains("checkBoxOff")) {
        toggleClassesObj("compara.ro","hide");
        redrawBoxes();
    }
}