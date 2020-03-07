
function index_functions()
{
    rec_items();
}


function rec_items()
{
    var text=""
    var i=0;
    text=text+"<div class='rec_items_wrapper'>";
    for(i=0;i<4;i++)
    {
        text=text+"<div class='rec_item'> " +
                        "<img class='rec_img' src='https://p1.akcdn.net/full/451032871.allview-x4-soul-lite-16gb.jpg'>" +
                        "<div class='space'\"></div>"+
                        "<rec_text>Allview X4 Soul Lite 16GB</rec_text>"+
                        "<div class='space'\"></div>"+
                        "<br>"+
                        "<br>"+
                        "<rec_text>De la 1032 RON</rec_text>"+
                    "</div>";
    }
    text=text+"</div>";
    document.getElementById("rec_box").innerHTML=text;
}

