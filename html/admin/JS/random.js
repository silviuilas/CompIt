var slideToggle=0;
function slideBurger(){
    width=document.body.offsetWidth;
    if(slideToggle===0) {
        if(width>1000){
        _('.side-panel').slideWidth(50, null, null, function () {slideToggle=1;});
        let main = document.getElementsByClassName('main')[0].offsetWidth;
        _('.main-panel').slideWidth(main - 51);
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
            let main = document.getElementsByClassName('main')[0].offsetWidth;
            _('.main-panel').slideWidth(main - 251);
        }
        else{
            _('.side-panel').slideHeight(0, null, null, function () {slideToggle=0;});
        }
    }
}