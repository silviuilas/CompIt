///modify rec
function getComms(){
    url=_URL+'/AJAX/comm_manager.php';
    console.log(url);
    _().post(url,{function:'show',itemId:'0'},function(result){
        console.log(result.data);
        showComms(result.data);
    })
}
function showComms(data){
    let text="";
    for(let i=0;i<data.length;i++){
        let name =data[i][1+6];
        if(name==null)
            name="Anonim";
        if (name.length > 40)
            name = name.slice(0, 38) + "...";
        text+= "<div class='comm-wrap' id='com-id-"+data[i][0]+"'>"+
            "<div class='comm-item'>"+
            "<div class='comm-info'>"+
            "<div class='comm-name'>" + "Nume: "+ name+ "</div>" +
            "<div class='comm-titlu'>" + "Titlu: "+ data[i][2] + "</div>"+
            "</div>"+
            "<div class='comm-text'>" + data[i][3] + "</div>" +
            "<div class='button' style='padding: 5px 15px;background: orangered' onclick='createPopupOnRemove("+data[i][0]+")'>Remove Item</div>"+
            "</div>" + "</div>" + "<div style=\"clear:both;\"></div>";
    }
    document.getElementById('com-items').innerHTML=text;
}
function removeItem(nr){
    if(document.getElementById('com-id-'+nr).style.opacity==="")
        _().post(_URL+'/AJAX/comm_manager.php',{id:nr,function:'remove'},function(){
            _('#com-id-'+nr).slideHeight(0,null,null,function(){document.getElementById('com-id-'+nr).style.display="none"});
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

getComms();