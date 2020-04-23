var name=document.getElementById("search_name").innerText.slice(18).slice(0,-1);
var offset=0;
var search_items_array=[];
var fadeInAnimationComplete=0;

_(window).scroll(function() {
    if(window.scrollY +  window.outerHeight >  document.body.offsetHeight - 100) {
        load_search_items();
    }
});

function load_search_items(){
    //Don't request until all the animations have ended
    if(fadeInAnimationComplete===0) {
        fadeInAnimationComplete=1;
        let _current_url = _URL + "/API/search_api.php?search=" + name + "&offset=" + offset * 25;
        _().ajax({
            url: _current_url,
            contentType: "application/json",
            dataType: 'json',
            success: function (result) {
                result.data.forEach(function (item) {
                    search_items_array.push(item);
                });
                search_items(offset);
                offset++;
            }
        });
    }
}
function search_items(off) {
    let text = "";
    let i;

    for (i = off*25; i < search_items_array.length; i++) {
        let name = search_items_array[i][2];
        if (name.length > 40)
            name = name.slice(0, 38) + "...";
        text = text + "<a href='"+_URL+"/PHP/pageGenerator.php?name="+search_items_array[i][2]+"'>"+
            "<div class='item_slide'>" +
            "<img class='item_slide_img' src='" + search_items_array[i][4] + "'>" +
            "<div class='space'\"></div>" +
            "<div class='item_slide_text'>" + name + "</div class='rec_text'>" +
            "<div class='space'\"></div>" +
            "<div class='item_slide_price'>" + search_items_array[i][3] + " RON</div class='rec_text_price'>" +
            "</div>"
            +"</a>"
        ;
    }
    document.getElementById("search_box").innerHTML += text;
    let x = document.getElementById("search_box").getElementsByClassName("item_slide");
    for (i = off*25; i < search_items_array.length-1; i++) {
        _(x[i]).fadeIn(40);
    }
    _(x[24]).fadeIn(40,function(){
        //When all the animations are over
        fadeInAnimationComplete=0;
        if(window.scrollY + window.outerHeight > document.body.offsetHeight-100) {
        load_search_items();
    }});
}
load_search_items();
