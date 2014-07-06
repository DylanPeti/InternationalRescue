(function ($) {

    /**
     * Update input id value with current position
     *
     * @param selector all items with a value pos
     */
    function update_artworks_position(selector) {

        return selector.each(function () {
            $(this).find("input[type=hidden]").val($(this).index() + 1);
            $(this).find(window.admin_artworks.position_display).text($(this).index() + 1);
        });
    }

    /**
     * Update alternate row class
     *
     * @param selector all items
     */
    function update_artworks_alternate_class(selector) {

        selector.removeClass('alternate');

        return selector.each(function () {
            if ($(this).index() % 2 == 1) {
                $(this).addClass('alternate');
            }
        });
    }

    /**
     * READY
     */
    $(function () {

        // Sortable artworks
        $( window.admin_artworks.sortable_item).sortable({
            cursor: "move",

            // Update artworks order
            update: function (event, ui) {

                var items = ui.item.siblings().andSelf();

                // update_artworks_alternate_class
                update_artworks_alternate_class(items);

                // Update positions in html
                var updated = update_artworks_position(items);

                // Ajax, update positions in database
                var form = $(this).parents('form');
                var ajaxData = form.serialize();
                $.ajax({
                    type: form.prop('method'),
                    url: window.admin_artworks.ajaxurl,
                    data: ajaxData,
                    success: function(data) {

                    }
                });
            },

            change: function (event, ui) {

                ui.item.css('border', '1px red dashed');
            }
        });

        $( window.admin_artworks.sortable_item ).disableSelection();
    })

} (jQuery));