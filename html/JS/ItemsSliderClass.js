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
        text=text+"<div class='item_slide_wrapper'>";
        for(let i=0;i<this.maxItems;i++) {
            //THIS IS MADE TO MAKE A COPY OF A STRING
            let name = (' ' + this.items[i][2]).slice(1);
            if(name.length>40)
                name=name.slice(0,38)+"...";
            text=text+ "<a href='"+_URL+"/PHP/pageGenerator.php?name="+this.items[i][2]+"'>"+
                "<div class='item_slide "+this.items[i][7]+"'>"+
                    "<img class='item_slide_img' src='"+this.items[i][4]+"'>" +
                    "<div class='space'\"></div>"+
                    "<div class='item_slide_text'>"+name+"</div>"+
                    "<div class='space'\"></div>"+
                    "<div class='item_slide_price'>" + this.items[i][3] +" RON</div>"+
                "</div>"
                +"</a>"
            ;

        }
        if(this.maxRenderItems<this.maxItems) {
            text = text + "<a class='prev' onclick='" + this.locationId + ".plusSlides(-1)'>&#10094;</a>";
            text = text + "<a class='next' onclick='" + this.locationId + ".plusSlides(1)'>&#10095;</a>";
        }
        text=text+"</div>";
        if(this.maxItems===0){
           _(document.getElementById(this.locationId)).hide();
        }
        document.getElementById(this.locationId).innerHTML=text;
    }
    redraw(){
        let elem=document.getElementById(this.locationId);
        let elements=elem.getElementsByClassName("item_slide");
        let nr=0;
        for(let i=0;i<elements.length;i++){
            if (window.getComputedStyle(elements[i]).display === "none") {
                nr++;
            }
        }
        this.maxRenderItems=this.items.length-nr;
        if(this.maxRenderItems<this.maxItems) {
            if(elem.getElementsByClassName("prev")[0]!=null) {
                elem.getElementsByClassName("prev")[0].style.display = "none";
            }
            if(elem.getElementsByClassName("next")[0]!=null) {
                elem.getElementsByClassName("next")[0].style.display = "none";
            }
        }
        else{
            if(elem.getElementsByClassName("prev")[0]!=null) {
                elem.getElementsByClassName("prev")[0].style.display = "";
            }
            if(elem.getElementsByClassName("next")[0]!=null) {
                elem.getElementsByClassName("next")[0].style.display = "";
            }
        }
    }
}
function redrawBoxes(){
    admin_rec_box.redraw();
    rec_box.redraw();
    last_viewed.redraw();
    today_deal_box.redraw();
}
let shopify_array=[];
function getRssFromSpotify(){
    _().get("https://www.compit.dev/media/shopify.xml",function (result){
        let parser = new DOMParser();
        let xmlDoc = parser.parseFromString(result,"text/xml");
        let items=xmlDoc.getElementsByTagName("item");
        for(let i=0;i<items.length;i++) { //replace(/ *\<[^)]*\> */g, "")
            shopify_array[i]=[];
            shopify_array[i][7]="shopify.ro";
            shopify_array[i][3]="__";//price
            shopify_array[i][4]=items[i].childNodes[5].textContent.trim(); //img link
            shopify_array[i][2]=items[i].childNodes[1].textContent.trim(); //name
            shopify_array[i][8]=items[i].childNodes[3].textContent.trim(); //link
        }
        let shopify =new ItemsSliderClass(shopify_array,"shopify");
        shopify.makeItems();
        for(let i=0;i<items.length;i++) {
            document.getElementById("shopify").getElementsByTagName('a')[i].setAttribute("href",shopify_array[i][8]);
        }
    });
}
let admin_rec_box =new ItemsSliderClass(admin_rec_items_array,"admin_rec_box");
admin_rec_box.makeItems();
let rec_box =new ItemsSliderClass(rec_items_array,"rec_box");
rec_box.makeItems();
let last_viewed= new ItemsSliderClass(last_items_viewed,"last_viewed");
last_viewed.makeItems();
let today_deal_box =new ItemsSliderClass(today_deal_items_array,"today_deal_box");
today_deal_box.makeItems();
getRssFromSpotify();
