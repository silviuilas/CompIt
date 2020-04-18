var _URL = "https://compit.dev";
var _Loaded_Vendors=null;
var _Curr_path;
_(function(){
    _('#checkPage').click(changePage);
    _('#checkMainPage').click(changePage);
    _('#view_prices_vendors').click(showItems);
    _('#view_prices_history').click(showImg);
    function make_request() {
        chrome.tabs.query({active: true, lastFocusedWindow: true}, tabs => {
            let url = customEncode(tabs[0].url);
            // use `url` here inside the callback because it's asynchronous!
            console.log(url);
            let _current_url = _URL + "/API/api.php?uri="+url;
            console.log(_current_url);
            _().ajax({
                url: _current_url,
                contentType: "application/json",
                dataType: 'json',
                success: function (result) {
                    document.getElementById("wrapper").style.display="inline-block"
                    showItems(result.data);
                },
                error: function(){
                    showNothing();
                }
            })
        });
    }
    make_request();
});
function showNothing(){
    document.getElementById('error_case').style.display="flex";
}
function showImg(){
        document.getElementById('history_svg').style.display="";
        document.getElementById('prices_list').style.display="none";
}
function showItems(data_array){
    document.getElementById('history_svg').style.display="none";
    document.getElementById('prices_list').style.display="";
    if(_Loaded_Vendors!=null)
        data_array=_Loaded_Vendors;
    if(data_array!=null) {
        _Loaded_Vendors=data_array;
        function showElement(item) {
            document.getElementById('prices_list').innerHTML +=
                "<a href='"+item['link']+"'  target=\"_blank\">"+
                    "<div class='in_item'>" +
                        "<div class='in_item_shopimg_box'>" +
                            "<img class='in_item_shopimg_img'src='" + item['shopimg'] + "'>" +
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

        document.getElementById('prices_list').innerHTML = "<div class='in_items_wrapper'>";
        data_array['items'].forEach(showElement);
        _Curr_path="/PHP/pageGenerator.php?name="+data_array['name'];
        document.getElementById('prices_list').innerHTML += '</div>';
        let x = document.getElementsByClassName('in_item');
        let i;
        for (i = 0; i < x.length; i++) {
            if(!(i%2===0))
                x[i].style.background = "white";
            else
                x[i].style.background="lightgray";
        }
    }
}


function changePage(){
    if(_Curr_path)
        chrome.tabs.create({"url": _URL+_Curr_path});
    else
        chrome.tabs.create({"url": _URL});
}
function customEncode(str){
    str = str.split("&").join("%26").split("+").join("%2B").split(" ").join("%20");
    return str;
}