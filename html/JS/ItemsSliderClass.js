class ItemsSliderClass{
    constructor(items,locationId) {
        this.items=items;
        this.locationId=locationId;
        this.slideIndex=1;
        this.maxItems=items.length;
        this.maxRenderItems=Math.floor(document.getElementById(this.locationId).clientWidth/150);
        }
    plusSlides(n){
        this.showSlides(this.slideIndex+=n);
    }
    showSlides(n){
        let x = document.getElementById(this.locationId).getElementsByClassName("item_slide");
        if(((n-1)*2)+this.maxRenderItems>=this.maxItems+1) {
            this.slideIndex=1;
        }
        if(n<=0)
        {
            this.slideIndex=Math.floor(((this.maxItems)-this.maxRenderItems)/2)+1;
        }
        n=this.slideIndex;
        let precent=(n-1)*300;
        let i;
        for (i = 0; i < x.length; i++) {
            x[i].style.transform = "translateX(-" + precent + "px)";
        }
    }
    makeItems() {
        let text="";
        let i=0;
        text=text+"<div class='item_slide_wrapper'>";
        for(i=0;i<this.maxItems;i++) {
            //THIS IS MADE TO MAKE A COPY OF A STRING
            let name = (' ' + this.items[i][2]).slice(1);
            if(name.length>40)
                name=name.slice(0,38)+"...";
            text=text+ "<a href='"+_URL+"/PHP/pageGenerator.php?name="+this.items[i][2]+"'>"+
                "<div class='item_slide'>"+
                    "<img class='item_slide_img' src='"+this.items[i][4]+"'>" +
                    "<div class='space'\"></div>"+
                    "<div class='item_slide_text'>"+name+"</div>"+
                    "<div class='space'\"></div>"+
                    "<div class='item_slide_price'>" + this.items[i][3] +" RON</div>"+
                "</div>"
                +"</a>"
            ;

        }
        text=text+"<a class='prev' onclick='"+this.locationId+".plusSlides(-1)'>&#10094;</a>";
        text=text+"<a class='next' onclick='"+this.locationId+".plusSlides(1)'>&#10095;</a>";
        text=text+"</div>";
        if(this.maxItems===0){
           _(document.getElementById(this.locationId)).hide();
        }
        document.getElementById(this.locationId).innerHTML=text;
    }
}
let admin_rec_box =new ItemsSliderClass(admin_rec_items_array,"admin_rec_box");
admin_rec_box.makeItems();
let rec_box =new ItemsSliderClass(rec_items_array,"rec_box");
rec_box.makeItems();
let last_viewed= new ItemsSliderClass(last_items_viewed,"last_viewed");
last_viewed.makeItems();
