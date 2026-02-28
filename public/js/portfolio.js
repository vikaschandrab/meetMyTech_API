(function () {
    function collapseNav() {
        if (window.jQuery && jQuery('.navbar-collapse').length) {
            jQuery('.navbar-collapse').collapse('hide');
        }
    }

    document.querySelectorAll('.navbar-nav .nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            collapseNav();
        });
    });
})();
