// Blog Carousel Initialization
$(document).ready(function(){
    // Check if blog slider exists and has items before initializing
    if ($('.mh-blog-slider').length && $('.mh-blog-slider .item').length > 0) {
        $('.mh-blog-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    }
});
