///modify rec
function getModifyRecItems(){
    url=_URL+'/AJAX/modify_rec_prod.php';
    console.log(url);
    _().post(url,{function:'show'},function(result){
        console.log(result.data);
        showModifyRecItems(result.data);
    })
}
function showModifyRecItems(data){
    let text="";
    for(let i=0;i<data.length;i++){
        let name =data[i][2+5];
        if (name.length > 40)
            name = name.slice(0, 38) + "...";
        text+= "<div class='rec-add-item-wrap' id='rec-item-id-"+data[i][0]+"'>"+
                    "<div class='rec-add-item' style='display: inline;'>"+
                        "<div class='rec-add-img-wrap'>"+
                        "<img class='rec-add-img' src='" + data[i][4+5] + "'>"+
                        "</div>"+
                        "<div class='rec-add-name-price-wrap'>"+
                        "<div class='rec-add-name'>"+name+"</div>"+
                        "<div class='rec-add-price'>De la : "+data[i][3+5]+" lei</div>"+
                        "<div class='button' style='padding: 5px 15px;background: orangered' onclick='createPopupOnRemove("+data[i][0]+")'>Remove Item</div>"+
                        "</div>" +
                        "<div class='rec-item-stats'>" +
                            "<div class='button order-buttons' onclick='moveRecItem("+data[i][0]+",-1,this)'>+</div>"+
                            "<div class='button order-buttons' onclick='moveRecItem("+data[i][0]+",+1,this)'>-</div>"+
                        "</div>"+
                    "</div>"+
                "</div>";
    }
    document.getElementById('rec-items').innerHTML=text;
}
function moveRecItem(nr,sign,obj){
    _().post(_URL+'/AJAX/modify_rec_prod.php',{function:'switch',id:nr,sign:sign},function(result){
        if(result.data!=null) {
            let first = document.getElementById('rec-item-id-' + nr);
            let second = document.getElementById('rec-item-id-' + result.data[1][0]);
            let firstCln = first.cloneNode(true);
            let secondCln = second.cloneNode(true);
            if (sign === -1) {
                second.parentNode.insertBefore(firstCln, second);
            } else {
                second.parentNode.insertBefore(firstCln, second.nextSibling);
            }
            first.parentNode.removeChild(first);
        }
    });
}
function removeItem(nr){
    if(document.getElementById('rec-item-id-'+nr).style.opacity==="")
        _().post(_URL+'/AJAX/modify_rec_prod.php',{id:nr,function:'remove'},function(){
            _('#rec-item-id-'+nr).slideHeight(0,null,null,function(){document.getElementById('rec-item-id-'+nr).style.display="none"});
        });
    closeRemovePopup();
}
function createPopupOnRemove(nr){
    document.getElementById("rec-remove-pop").style.display="inline";
    _('#rec-remove-pop').slideHeight(200);
    document.getElementById("rec-remove-pop").innerHTML="<div style='margin-top: 35px; margin-bottom: 20px;' width='100%'> Esti sigur ca vrei sa stergi acest produs din lista de recomandate?</div>"+
        "<div class='button' style='margin: 0 20px;padding:10px 20px' onclick='removeItem("+nr+")'>Da</div>"+
        "<div class='button' style='margin: 0 20px;padding:10px 20px' onclick='closeRemovePopup()'>Nu</div>"
}
function closeRemovePopup(){
    _("#rec-remove-pop").slideHeight(0,null,null,function(){document.getElementById("rec-remove-pop").style.display="none";});
}

getModifyRecItems();