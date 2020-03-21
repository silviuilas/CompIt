var name=document.getElementById("search_name").innerText.slice(18).slice(0,-1);
var offset=0;
var search_items_array=[];
var ok=0;

$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
        if(ok==0)
            {   ok=1;
                load_search_items(offset);
            }
    }
});

function load_search_items(){
    let _current_url = _URL + "/API/search_api.php?search=" +name+"&offset="+offset*25;
    let _short_url= _URL + "/API/search_api.php";
    $.ajax({
        url: _current_url,
        contentType: "application/json",
        dataType: 'json',
        success: function(result){
            result.data.forEach(function (item){
            search_items_array.push(item);
            });
            search_items();
            offset++;
        }
    });
}
function search_items() {
    let text = "";
    let i;

    for (i = offset*25; i < search_items_array.length; i++) {
        var name = search_items_array[i][2];
        if (name.length > 40)
            name = name.slice(0, 38) + "...";
        text = text + "<a href='"+_URL+"/PHP/pageGenerator.php?name="+search_items_array[i][2]+"'>"+
            "<div class='rec_item'>" +
            "<img class='rec_img' src='" + search_items_array[i][4] + "'>" +
            "<div class='space'\"></div>" +
            "<div class='rec_text'>" + name + "</div class='rec_text'>" +
            "<div class='space'\"></div>" +
            "<div class='rec_text_price'>" + search_items_array[i][3] + " RON</div class='rec_text_price'>" +
            "</div>"
            + "</a>"
        ;
    }
    document.getElementById("search_box").innerHTML += text;
    let x = document.getElementsByClassName("rec_item");
    for (i = offset*25; i < search_items_array.length; i++) {
        $(x[i]).hide().fadeIn(1000);
    }
    setTimeout(function() {
        ok=0;
    }, 1100);

}
ok=1;
load_search_items(0);
