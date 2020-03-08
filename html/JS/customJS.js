
function index_functions()
{
    rec_items();
}


function rec_items()
{
    var text="";
    var i=0;
    text=text+"<div class='rec_items_wrapper'>";
    for(i=0;i<4;i++)
    {
        var name=items_array[i][2];

        if(name.length>40)
            name=name.slice(0,38)+"...";
        text=text+ "<a href='"+items_array[i][5]+"'>"+
                    "<div class='rec_item'>"+
                        "<img class='rec_img' src='"+items_array[i][4]+"'>" +
                        "<div class='space'\"></div>"+
                        "<div class='rec_text'>"+name+"</div class='rec_text'>"+
                        "<div class='space'\"></div>"+
                        "<div class='rec_text_price'>" + items_array[i][3] +" RON</div class='rec_text_price'>"+
                    "</div>"
                    +"</a>"
                    ;

    }
    text=text+"</div>";
    document.getElementById("rec_box").innerHTML=text;
}

