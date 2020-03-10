function index_functions() {
    rec_items();
}
var max_items=20;
var slideIndex = 1;
//showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function showSlides(n){
    let x = document.getElementsByClassName("rec_item");
    let i;
    if(n>=(max_items/2)-2) {
        slideIndex=1;
    }
    if(n<=0)
        {slideIndex=(max_items/2)-2;
        }
    n=slideIndex;
    let precent=(n-1)*300;
    for (i = 0; i < x.length; i++) {
        x[i].style.transform = "translateX(-" + precent + "px)";
    }


}
function rec_items() {
    let text="";
    let i=0;
    text=text+"<div class='rec_items_wrapper'>";
    for(i=0;i<max_items;i++) {
        var name=rec_items_array[i][2];
        if(name.length>40)
            name=name.slice(0,38)+"...";
        text=text+ "<a href='"+rec_items_array[i][5]+"'>"+
                    "<div class='rec_item'>"+
                        "<img class='rec_img' src='"+rec_items_array[i][4]+"'>" +
                        "<div class='space'\"></div>"+
                        "<div class='rec_text'>"+name+"</div class='rec_text'>"+
                        "<div class='space'\"></div>"+
                        "<div class='rec_text_price'>" + rec_items_array[i][3] +" RON</div class='rec_text_price'>"+
                    "</div>"
                    +"</a>"
                    ;

    }
    text=text+"</div>";

    text=text+"<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>";
    text=text+"<a class='next' onclick='plusSlides(1)'>&#10095;</a>";
    document.getElementById("rec_box").innerHTML=text;
}

