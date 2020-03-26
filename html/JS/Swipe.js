class Swipe {
    constructor(element) {
        this.xDown = null;
        this.yDown = null;
        this.element = element;
        if(!this.element)
            alert("null element in Swipe.js")
        else
            this.element.addEventListener('touchstart', function(evt) {
            this.xDown = evt.touches[0].clientX;
            this.yDown = evt.touches[0].clientY;
        }.bind(this), false);

    }

    onLeft(callback) {
        this.onLeft = callback;

        return this;
    }

    onRight(callback) {
        this.onRight = callback;

        return this;
    }

    onUp(callback) {
        this.onUp = callback;

        return this;
    }

    onDown(callback) {
        this.onDown = callback;

        return this;
    }

    handleTouchMove(evt) {
        if ( ! this.xDown || ! this.yDown ) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        this.xDiff = this.xDown - xUp;
        this.yDiff = this.yDown - yUp;

        if ( Math.abs( this.xDiff ) > Math.abs( this.yDiff ) ) { // Most significant.
            if ( this.xDiff > 0 ) {
                this.onLeft();
            } else {
                this.onRight();
            }
        } else {
            if ( this.yDiff > 0 ) {
                this.onUp();
            } else {
                this.onDown();
            }
        }

        // Reset values.
        this.xDown = null;
        this.yDown = null;
    }

    run() {
        this.element.addEventListener('touchmove', function(evt) {
            this.handleTouchMove(evt);
        }.bind(this), false);
    }
}
var swiper = new Swipe(document.getElementById("rec_box"));
swiper.onRight(function() {rec_box.plusSlides(-1);});
swiper.onLeft(function() {rec_box.plusSlides( +1);});
swiper.run();
var swiper2 = new Swipe(document.getElementById("last_viewed"));
swiper2.onRight(function() {last_viewed.plusSlides( -1);});
swiper2.onLeft(function() {last_viewed.plusSlides( +1);});
swiper2.run();
