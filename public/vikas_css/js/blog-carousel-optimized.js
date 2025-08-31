// Performance-Optimized Blog Carousel and Mobile Management
$(document).ready(function(){
    // Performance monitoring
    const perfStart = performance.now();

    // Cached jQuery objects for better performance
    const $window = $(window);
    const $blogSlider = $('.mh-blog-slider');
    const $hiddenBlogs = $('.hidden-blog');
    const $showMoreBtn = $('#show-more-blogs');
    const $showLessBtn = $('#show-less-blogs');
    const $blogsSection = $('#mh-blogs');

    // Configuration
    const config = {
        breakpoint: 768,
        blogsPerLoad: 2,
        animationDuration: 300,
        scrollOffset: 100,
        resizeDebounce: 250,
        carouselSettings: {
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            autoplay: false, // Disabled for better performance
            smartSpeed: 600,
            lazyLoad: true,
            responsive: {
                768: { items: 2 },
                1000: { items: 3 }
            }
        }
    };

    // Performance-optimized carousel initialization
    function initBlogCarousel() {
        if ($window.width() >= config.breakpoint) {
            // Destroy existing carousel if it exists
            if ($blogSlider.hasClass('owl-loaded')) {
                $blogSlider.trigger('destroy.owl.carousel').removeClass('owl-loaded owl-drag');
            }

            // Initialize carousel for desktop/tablet only if items exist
            if ($blogSlider.length && $blogSlider.find('.item').length > 0) {
                try {
                    $blogSlider.owlCarousel(config.carouselSettings);
                    console.log('Blog carousel initialized successfully');
                } catch (error) {
                    console.warn('Blog carousel initialization failed:', error);
                }
            }
        } else {
            // Destroy carousel on mobile if it exists
            if ($blogSlider.hasClass('owl-loaded')) {
                $blogSlider.trigger('destroy.owl.carousel').removeClass('owl-loaded owl-drag');
            }
        }
    }

    // Optimized mobile blog management with virtual scrolling
    function initMobileBlogDisplay() {
        if ($hiddenBlogs.length === 0) return;

        let visibleBlogs = 2;
        let isLoading = false;

        // Update button text helper
        function updateButtonText() {
            const remaining = $hiddenBlogs.filter(':hidden').length;
            if (remaining > 0) {
                $showMoreBtn.html(`<i class="fa fa-plus"></i> Show More (${remaining} remaining)`);
            } else {
                $showMoreBtn.hide();
                $showLessBtn.show();
            }
        }

        // Show more functionality with batching
        $showMoreBtn.on('click', function(e) {
            e.preventDefault();

            if (isLoading) return;

            isLoading = true;
            const $button = $(this);
            $button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');

            const $hiddenToShow = $hiddenBlogs.filter(':hidden').slice(0, config.blogsPerLoad);

            if ($hiddenToShow.length > 0) {
                // Use requestAnimationFrame for smooth animation
                requestAnimationFrame(function() {
                    $hiddenToShow.fadeIn(config.animationDuration, function() {
                        visibleBlogs += $hiddenToShow.length;
                        isLoading = false;
                        $button.prop('disabled', false);
                        updateButtonText();
                    });
                });
            } else {
                isLoading = false;
                $button.prop('disabled', false);
                updateButtonText();
            }
        });

        // Show less functionality with smooth scroll
        $showLessBtn.on('click', function(e) {
            e.preventDefault();

            if (isLoading) return;

            isLoading = true;

            $hiddenBlogs.fadeOut(config.animationDuration, function() {
                visibleBlogs = 2;
                isLoading = false;

                // Reset buttons
                $showLessBtn.hide();
                $showMoreBtn.show().prop('disabled', false);
                updateButtonText();

                // Smooth scroll back to blogs section
                if ($blogsSection.length) {
                    $('html, body').animate({
                        scrollTop: $blogsSection.offset().top - config.scrollOffset
                    }, 500);
                }
            });
        });

        // Initialize button text
        updateButtonText();
    }

    // Lazy loading for blog images
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            img.classList.add('loaded');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.1
            });

            // Observe all lazy images
            $('.blog-image img[data-src]').each(function() {
                imageObserver.observe(this);
            });
        } else {
            // Fallback for older browsers
            $('.blog-image img[data-src]').each(function() {
                const $img = $(this);
                $img.attr('src', $img.data('src')).removeClass('lazy').addClass('loaded');
            });
        }
    }

    // Debounced resize handler
    let resizeTimer;
    function handleResize() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            initBlogCarousel();
        }, config.resizeDebounce);
    }

    // Main initialization
    function init() {
        try {
            initBlogCarousel();
            initMobileBlogDisplay();
            initLazyLoading();

            // Bind resize handler
            $window.on('resize', handleResize);

            // Performance logging
            const perfEnd = performance.now();
            console.log(`Blog carousel module loaded in ${(perfEnd - perfStart).toFixed(2)}ms`);

        } catch (error) {
            console.error('Blog carousel initialization error:', error);
        }
    }

    // Initialize everything
    init();

    // Preload critical images on hover (desktop only)
    if ($window.width() >= config.breakpoint) {
        $('.mh-blog-item').on('mouseenter', function() {
            const $img = $(this).find('img[data-src]').first();
            if ($img.length && $img.data('src') && !$img.attr('src')) {
                $img.attr('src', $img.data('src'));
            }
        });
    }

    // Expose public API for external use
    window.BlogCarousel = {
        reinit: init,
        destroy: function() {
            if ($blogSlider.hasClass('owl-loaded')) {
                $blogSlider.trigger('destroy.owl.carousel').removeClass('owl-loaded owl-drag');
            }
            $window.off('resize', handleResize);
        }
    };
});
