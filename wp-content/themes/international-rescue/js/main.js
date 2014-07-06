jQuery(document).ready(function($) {
    // Nav slide Out menu
    // var $nav = $('#main-menu');

    // $nav.mmenu({
    //     class: "mm-slide",
    //     position: "right"
    // });


    // Menu open

    var $burger = $('#menu-burger');
    var $close = $('#menu-cross');
    var $container = $('.container');


    $burger.click(function(){
        openNav();
    });

    $close.click(function(){
        closeNav();
    });

    function openNav() {
        $container.addClass('nav-open');
    }

    function closeNav() {
        $container.removeClass('nav-open');
        $container.addClass('closing');
        setTimeout(function () {
            $container.removeClass('closing');
        },400);
    }

    // Drop down menu for desktop
    $('.filters.desktop').on('click', '.filter[data-filter-block]', function () {

        var parent        = $('#dropdowns');
        var dropdownName  = $(this).attr('data-filter-block');
        var dropdown      = parent.find('#'+dropdownName);

        // Display filter
        if ('object' == typeof dropdown && dropdown.is(':hidden')) {
            parent.show();
            parent.find('.filter-block').hide();
            dropdown
                .stop(true, true)
                .fadeIn({ duration: 1500, queue: false })
                .css('display', 'none')
                .slideDown(500);

            // Columnize filter block artist when it is displayed only
            if (dropdown.is('#filter-block-artist') && false == dropdown.hasClass('columnized')) {
                $('#filter-block-artist').columnize({
                    columns: 4
                });
                dropdown.addClass('columnized');
            }
        } else {
            // Hide filter
            dropdown
                .stop(true, true)
                .fadeOut({ duration: 500, queue: false })
                .slideUp(500, function () {
                    parent.find('.filter-block').hide();
                    parent.hide();
                });

        }
    });

    // Drop down select for mobile
    $('.container').on('change', '#mobile-dropdowns select', function () {
        var redirectUrl = $(this).val();
        if (redirectUrl !== '') {
            window.location.href = redirectUrl;
        }
    });

    imageLazy();

    // Image lazy, remove class lazy so infinite scroll only target new images
    function imageLazy() {
        $("img.lazy").lazyload({
            effect : "fadeIn",
            failure_limit : 80
        }).removeClass("lazy");
    }


    // gallery
    var $slideshow = $('#slideshow'), $counter = $('.position .current');
    if($slideshow.length)
        new Slideshow($slideshow, $slideshow.find('#next'), $slideshow.find('#prev'));

    $slideshow.on('change', function(event, index) {
        $counter.html(index + 1);
    });

    function Slideshow($container, $next, $prev) {
        var $current = $container.find("[data-position='centre']"),
            total = $container.find('[data-position]').length,
            index = 0;

        this.nextClick = function(event) {
            var $found = this.find('next');
            this.move($found, 'right', 'left');
        };

        this.prevClick = function(event) {
            var $found = this.find('prev');
            this.move($found, 'left', 'right');
        };

        this.find = function(direction) {
            var $found = $current[direction]();
            // if not found, we loop thing around
            if(!$found.length) {
                if(direction === 'next') {
                    $found = $current.parent().find('[data-position]:first-child');
                } else {
                    $found = $current.parent().find('[data-position]:last-child');
                }
            }

            if(direction === 'next') {
                index += 1;
                if(index === total) index = 0;
            } else {
                index -= 1;
                if(index < 0) index = total -1;
            }

            return $found;
        };

        this.move = function($node, from, to) {
            // make sure the found node is on the right side first
            $node.removeClass('transition').attr('data-position', from);

            // wait till next tick to animation its position in
            setTimeout(function() {
                $node.addClass('transition').attr('data-position', 'centre');
                $current.addClass('transition').attr('data-position', to);

                setTimeout(function() {
                    $current = $node;
                    self.signal();
                }, 400);
            });
        };

        this.signal = function() {
            $slideshow.trigger('change', index);
        };

        if(total > 1) {
            // binding events
            $next.on('click', $.proxy(this.nextClick, this));
            $prev.on('click', $.proxy(this.prevClick, this));

            var self = this;
            $(document).on('keydown', function(event) {
                if(event.keyCode === 39) self.nextClick();
                else if(event.keyCode === 37) self.prevClick();
            });
        } else {
            $next.hide();
            $prev.hide();
        }

        var $win = $(window);
        var resize = $.throttle(300, function() {
            // update container height
            var height = $win.height();
            $container.height(Math.max(850, height - 300));

            $container.find('[data-position]').each(function() {
                var $this = $(this),
                    $caption = $this.find('.image-caption').first(),
                    width = $this.width(), height = $this.height(),
                    elmWidth, elmHeight,
                    elmRatio = $this.data('ratio'), ratio = width / height;

                if(ratio > elmRatio) {
                    elmHeight = height;
                    elmWidth = height * elmRatio;
                } else {
                    elmWidth = width;
                    elmHeight = width / elmRatio;
                }

                $caption.width(elmWidth);
                $caption
                    .css('top', elmHeight + (height - elmHeight) / 2)
                    .addClass('show');
            });
        });
        resize();
        $win.on('resize', resize);
    }


    // Infinite scroll
    $('.content .artworks-container').infinitescroll({
        navSelector : "a.next-page",
        // selector for the paged navigation (it will be hidden)
        nextSelector : "a.next-page",
        // selector for the NEXT link (to page 2)
        itemSelector : ".item",

        // selector for all items you'll retrieve
        pathParse: function (path, currentPage) {
            // Parse out the URL into chunks here
            // `chunkedUrl` should be `["/path/to/resource?page=", "&foo=bar&dynamic=CA735B#!random-hashbang"]`
            return [path];
        },
        loading: {
            finishedMsg: "<hr />",
            img: "data:image/gif;base64,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",
            msgText: ''
        },
        prefill: true,
        appendCallback: false
    },
    function (data, opts) {

        // Fix for salvattore
        opts.loading.msg.remove();

        // Append images in salvattore columns
        var grid = $(this)[0];
        var items = data.get();
        salvattore['append_elements'](grid, items);
        // Image lazy fetched img
        imageLazy();

        if (items.length < 1) {
            opts.state.isDone = true;
        }
    });
 });
