
function search_items() {
    let text="";
    let i=0;
    text=text+"<div class='search_items_wrapper'>";
    for(i=0;i<search_items_array.length;i++) {
        var name=search_items_array[i][2];
        if(name.length>40)
            name=name.slice(0,38)+"...";
        text=text+ "<a href='"+search_items_array[i][5]+"'>"+
            "<div class='rec_item'>"+
            "<img class='rec_img' src='"+search_items_array[i][4]+"'>" +
            "<div class='space'\"></div>"+
            "<div class='rec_text'>"+name+"</div class='rec_text'>"+
            "<div class='space'\"></div>"+
            "<div class='rec_text_price'>" + search_items_array[i][3] +" RON</div class='rec_text_price'>"+
            "</div>"
            +"</a>"
        ;
    }
    text=text+"</div>";
    document.getElementById("search_box").innerHTML=text;
}