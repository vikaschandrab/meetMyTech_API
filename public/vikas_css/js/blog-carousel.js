// Blog Carousel Initialization
$(document).ready(function(){
    // Check if blog slider exists and has items before initializing
    if ($('.mh-blog-slider').length && $('.mh-blog-slider .item').length > 0) {
        // Initialize only on desktop and tablet
        if ($(window).width() > 768) {
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
    }

    // Handle mobile blog display
    function handleMobileBlogDisplay() {
        // CSS media queries handle the display, just ensure carousel works properly
        if ($(window).width() > 768) {
            if ($('.mh-blog-slider').length && $('.mh-blog-slider .item').length > 0 && !$('.mh-blog-slider').hasClass('owl-loaded')) {
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
        }
    }

    // Initialize mobile display
    handleMobileBlogDisplay();

    // Handle window resize
    $(window).resize(function() {
        handleMobileBlogDisplay();

        // Reinitialize carousel if needed
        if ($(window).width() > 768 && $('.mh-blog-slider').length && !$('.mh-blog-slider').hasClass('owl-loaded')) {
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
});
