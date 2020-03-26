
$(function() {
    //load_prices();
    load_prices_ajax();
});

function load_prices_ajax(){
    function modify_prices(data_array){
        if(data_array!=null) {
            if (data_array['imglink'] != null)
                document.getElementById('img_style').src = data_array['imglink'];

            function showElement(item) {
                document.getElementById('prices_list').innerHTML +=
                    "<a href='"+item['link']+"'>"+
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
