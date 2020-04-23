function search(elem) {
    if(event.key === 'Enter') {
        url=_URL+'/AJAX/search_ajax/?search='+elem.value;
        console.log(url);
        _().get(url,function(result){

            console.log(result);
            showSearch(result.data);
        })
    }
}
function showSearch(data){
    let text="";
    if(data!=null && data.length!==0){
        for( let i=0;i<data.length;i++){
            let name =data[i][2];
            if (name.length > 40)
                name = name.slice(0, 38) + "...";
            text+= "<div class='rec-add-item-wrap'>"+
                    "<div class='rec-add-item'>"+
                        "<div class='rec-add-img-wrap'>"+
                            "<img class='rec-add-img' src='" + data[i][4] + "'>"+
                        "</div>"+
                        "<div class='rec-add-name-price-wrap'>"+
                        "<div class='rec-add-name'>"+name+"</div>"+
                        "<div class='rec-add-price'>De la : "+data[i][3]+" lei</div>"+
                        "<div class='button' style='padding: 5px 15px' onclick='addItem("+data[i][0]+",this)'>Add item</div>"+
                        "</div>"+
                    "</div>"+
                    "</div>";
        }
    }
    else
    {
        text="<div style='margin:20px'>Nu am putut gasi produse cu acest nume</div>";
    }
    document.getElementById('modify-items').innerHTML=text;

}
function addItem(nr,obj){
    _().post(_URL+'/AJAX/modify_rec_prod.php',{function:'insert',id:nr},function(result){console.log(result);obj.style.opacity="0"});
}



