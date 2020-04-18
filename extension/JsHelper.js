let customLib = function(selector) {
    this.selector = selector || null;
    this.elements = null;
};
//region Functions
    //region Events
    customLib.prototype.on = function(event, callback) {
        for (let i = 0; i < this.elements.length; ++i)
            this.eventHandler.bindEvent(event, callback, this.elements[i]);
        return this;
    }
    customLib.prototype.off = function(event) {
        for (let i = 0; i < this.elements.length; ++i)
          this.eventHandler.unbindEvent(event, this.elements[i]);
        return this;
    }
    customLib.prototype.click = function( callback) {
        for (let i = 0; i < this.elements.length; ++i)
            this.eventHandler.bindEvent('click', callback, this.elements[i]);
        return this;
    }
    customLib.prototype.hover = function( callback) {
        for (let i = 0; i < this.elements.length; ++i)
            this.eventHandler.bindEvent('hover', callback, this.elements[i]);
        return this;
    }
    customLib.prototype.scroll = function( callback) {
        for (let i = 0; i < this.elements.length; ++i)
            this.eventHandler.bindEvent('scroll', callback, this.elements[i]);
        return this;
    }
    //endregion
    //region Helpers
    customLib.prototype.each = function(callback){
        if (!callback || typeof callback !== 'function') return;
        for (let i = 0; i < this.elements.length; i++) {
            callback(this.elements[i], i);
        }
        return this;
    }
    customLib.prototype.addClass = function(className){
        this.each(function (item){
            item.classList.add(className);
        })
        return this;
    }
    customLib.prototype.removeClass = function(className){
        this.each(function (item){
            item.classList.remove(className);
        })
        return this;
    }
    customLib.prototype.append = function(html) {
        this.each(function (item){
            item.innerHTML=item.innerHTML+html;
        })
        return this;
    };
    customLib.prototype.prepend = function(html) {
        this.each(function (item){
            item.innerHTML=html+item.innerHTML;
        })
    };
    customLib.prototype.html = function(html) {
        if(html===undefined)
            return this.elements[0].innerHTML;
        this.each(function (item){
            item.innerHTML=html;
        })
        return this;
    };
    customLib.prototype.fadeOut = function(timeOut) {
        timeOut=timeOut||40;
        this.each(function (item){
            let aux = item.style;
            aux.opacity = 1;
            (function recFadeOut(){(aux.opacity-=.05)<0?aux.display="none":setTimeout(recFadeOut,timeOut)})();
        })
        return this;
    };
    customLib.prototype.fadeIn = function(timeOut,callback) {
        timeOut=timeOut||40;
        this.each(function (item){
            let aux = item.style;
            aux.opacity="0";
            aux.display="";
            (function recFadeIn(){
                (Number(aux.opacity=String(Number(aux.opacity)+0.05))>0.95)?callback():setTimeout(recFadeIn,timeOut);
            })();
        })
        return this;
    };
    customLib.prototype.hide = function() {
        this.each(function (item) {
            let aux = item.style;
            aux.opacity = String(0);
            aux.display = "none";
        })
        return this;
    };
    customLib.prototype.show = function() {
        this.each(function (item) {
            let aux = item.style;
            aux.opacity = String(1);
            aux.display = "";
        })
        return this;
    };
    customLib.prototype.eq = function(pos) {
        if(pos<this.elements.length)
            return this.elements[eq];
    };
    //endregion
    //region AJAX
    customLib.prototype.ajax=function(args){
        //region Declaration
        let url=args.url;
        if(url==null)
        {
            console.log("You must specify an url");
            return;
        }
        let method = args.method || "GET";
        let success = args.success || function(result){console.log(result);};
        let error=args.error ||function(result){console.log(result);}
        let contentType=args.contentType || 'application/x-www-form-urlencoded; charset=UTF-8';
        //endregion
        //region Xhr Prep
        let xhr = new XMLHttpRequest();
        xhr.open(method,url);
        xhr.onload=function (){
            if(xhr.status===200){
                let obj = JSON.parse(xhr.response);
                success(obj);
            }
            else {
                error("Error");
            }
        }
        xhr.setRequestHeader('Content-Type', contentType);
        //endregion
        let text="";
        if(method==="GET"){
        }
        else if(method==="POST")
        {
            let data=args.data;
            let aux;

            for(aux in data){
                if(text.length>0)
                    text+="&";
                text+=aux+"="+data[aux];
            }
        }
        xhr.send(encodeURI(text));
    }
    customLib.prototype.get=function(url,funct){
        funct=funct|| function(result){console.log(result);}
        this.ajax({url:url,success:funct,method:'GET'});
    }
    customLib.prototype.post=function(url,data,funct){
        funct=funct|| function(result){console.log(result);}
        this.ajax({url:url,success:funct,data:data,method:'POST'});
    }
    //endregion
//endregion
//region EventHandler and Init
customLib.prototype.eventHandler = {
    events: [],
    bindEvent: function(event, callback, targetElement) {
        this.unbindEvent(event, targetElement);
        targetElement.addEventListener(event, callback, false);
        this.events.push({
            type: event,
            event: callback,
            target: targetElement
        });
    },
    findEvent: function(event) {
        return this.events.filter(function(evt) {
            return (evt.type === event);
        }, event)[0];
    },
    unbindEvent: function(event, targetElement) {
        let foundEvent = this.findEvent(event);
        if (foundEvent !== undefined) {
            targetElement.removeEventListener(event, foundEvent.event, false);
        }
        this.events = this.events.filter(function(evt) {
            return (evt.type !== event);
        }, event);
    }
};
customLib.prototype.init = function() {
    if(this.selector!=null) {
        switch (this.selector[0]) {
            case '<':
                let matches = this.selector.match(/<([\w-]*)>/);
                if (matches === null || matches === undefined) {
                    throw 'Invalid Selector';
                    return false;
                }
                let nodeName = matches[0].replace('<', '').replace('>', '');
                this.elements += document.createElement(nodeName);
                break;
            default:
                if(typeof this.selector=="function") {
                    this.elements=new Array(1);
                    this.elements[0] = document;
                    this.on('DOMContentLoaded',this.selector);
                }
                else if(typeof this.selector=="object"){
                    this.elements=new Array(1);
                    this.elements[0] = this.selector;
                }
                else{
                    this.elements = document.querySelectorAll(this.selector);
                }
        }
    }
};
//endregion
_ = function(selector) {
    let obj = new customLib(selector);
    obj.init();
    return obj;
}
//region TestBlocks
/*
_(".tesst").append("test").on('click',function(){alert("test")}).append("salut");
_().get("https://www.compit.dev/API/search_api.php?search=a&offset=0");
_(".test").each(function(){console.log("wtf")})
console.log(_('.test').html());
_('.test').fadeIn(50);
_(function(){alert(10);})
*/

//endregion
