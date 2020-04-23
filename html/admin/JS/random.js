var slideToggle=0;
function slideBurger(){
    width=document.body.offsetWidth;
    if(slideToggle===0) {
        if(width>1000){
        _('.side-panel').slideWidth(50, null, null, function () {slideToggle=1;});
        }
        else
        {
            _('.side-panel').slideHeight(null, null, null, function () {slideToggle=1;});
        }

    }
    else if(slideToggle===1){
        if(width>1000) {
            _('.side-panel').slideWidth(250, null, null, function () {
                slideToggle = 0;
            });
        }
        else{
            _('.side-panel').slideHeight(0, null, null, function () {slideToggle=0;});
        }
    }
}
function switchPage(page){
    _().get(_URL+'/PHP/switchPage.php?page='+page,function (result){
        document.getElementsByClassName('main-panel')[0].innerHTML=result;
        //Evaluate the scripts inside the tags with regex
        let match = result.match(/<script>(.*?)<\/script>/g);
        if(match!=null) {
            let scripts = match.map(function (val) {
                return val.replace(/<\/?script>/g, '');
            });
            for (let i in scripts)
                eval(scripts[i]);
        }
        width=document.body.offsetWidth;
        if(width<=1000)
            _('.side-panel').slideHeight(0, null, null, function () {slideToggle=0;});
    });
}