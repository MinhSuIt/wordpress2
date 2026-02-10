(function () {
    tinymce.create('tinymce.plugins.box_download', {
        init: function (editor) {
            editor.addButton('box_download', {
                text: 'Box Download',
                icon: false,
                onclick: function () {
                    editor.insertContent('[box_download]');
                }
            });
        }
    });

    tinymce.PluginManager.add('box_download', tinymce.plugins.box_download);
})();
