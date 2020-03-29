
$(function() {
    //load_prices();
    load_prices_ajax();
    make_stars();
});

function make_stars() {
    let text="";
    let i=0;
    for(i=0;i<5;i++)
        text+="<span class=\"fa fa-star\" onclick=\"rate_stars("+i+");\"></span>";
    document.getElementById("stars").innerHTML=text;
}
function rate_stars(star){
    let x=document.getElementsByClassName("fa fa-star");
    let prd_name=document.getElementById("item_name").innerHTML;
    $.ajax({
        type: "POST",
        url: _URL+"/API/rate_system.php",
        contentType: "application/json",
        dataType: 'json',
        data: {product_name: prd_name , rating:star},
        success: function(result){
            for(let i=0;i<=star;i++)
                x[i].style.color ="orange";
        }
    })

}
function load_prices_ajax(){
    function modify_prices(data_array){
        if(data_array!=null) {
            if (data_array['imglink'] != null)
                document.getElementById('img_style').src = data_array['imglink'];

            function showElement(item) {
                document.getElementById('prices_list').innerHTML +=
                    "<a href='"+item['link']+"' target=\"_blank\">"+
                    "<div class='in_item'>" +
                        "<div class='in_item_shopimg_box'>" +
                            "<img class='in_item_shopimg_img'src='" + item['shopimg'] + "'>" +
                        "</img>" +
                        "</div>" +
                        "<div class='in_item_shopname'>" +
                            item['shopname'] +
                        "</div>" +
                        "<div class='in_item_price'>" +
                            item['price'] +
                        "</div>" +
                    "</div>"+
                    "</a>"+
                    "<div class='space'></div>";

            }


            document.getElementById('prices_list').innerHTML += "<div class='in_items_wrapper'>";
            data_array['items'].forEach(showElement);
            document.getElementById('prices_list').innerHTML += '</div>';
        }

    }

    let _current_url = _URL + "/API/api.php?name=" + document.getElementById('item_name').innerText;
    $.ajax({
        url: _current_url,
        contentType: "application/json",
        dataType: 'json',
        success: function(result){
            modify_prices(result.data);
        }
    })
}
