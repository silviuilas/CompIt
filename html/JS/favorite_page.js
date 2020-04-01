let offset=0;
let fadeInAnimationComplete=0;

$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
        offset++;
        load_favorites();
    }
});

function load_favorites(){
    favorite_items(offset);
}
function favorite_items(off) {
    let text = "";
    let i;
    if(off*25>fav_items.length)
        return;
    for (i = off*25; i < fav_items.length; i++) {
        var name = fav_items[i][2];
        if (name.length > 40)
            name = name.slice(0, 38) + "...";
        text = text + "<a href='"+_URL+"/PHP/pageGenerator.php?name="+fav_items[i][2]+"'>"+
            "<div class='fav-item'>" +
                "<div class='fav_img_item_container'>"+
                    "<img class='fav_img_style' src='" + fav_items[i][4] + "'>" +
                "</div>"+
                "<div class='fav_information_fixed_box'>" +
                    "<h2 class='item_name'>" + name + "</h2>" +
                    "<h3 class='minprice'>" + fav_items[i][3] + " RON</h3>" +
                "</div>"+
            "</div>"
            +"</a>"
        ;
    }
    document.getElementById("favorite_box").innerHTML += text;
}

load_favorites();