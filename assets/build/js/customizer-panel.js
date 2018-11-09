(function ($) {
    wp.customizerCtrlEditor = {

        init: function () {

            jQuery(window).load(function () {

                jQuery('textarea.wp-editor-area').each(function () {
                    var tArea = jQuery(this),
                        id = tArea.attr('id'),
                        input = jQuery('input[data-customize-setting-link="' + id + '"]'),
                        editor = tinyMCE.get(id),
                        setChange,
                        content;
                    
                    if (editor) {
                        editor.onChange.add(function (ed, e) {
                            ed.save();
                            content = editor.getContent();
                            clearTimeout(setChange);
                            setChange = setTimeout(function () {
                                input.val(content).trigger('change');
                            }.bind(input), 500);
                        }.bind(input));                  
                       
                    }

                    tArea.css({
                        visibility: 'visible'
                    }).on('keyup', function () {
                        content = tArea.val();
                        clearTimeout(setChange);
                        setChange = setTimeout(function () {
                            input.val(content).trigger('change');                          
                        }, 500);
                    });
                });
            });
        }

    };

    wp.customizerCtrlEditor.init();


})(jQuery);
