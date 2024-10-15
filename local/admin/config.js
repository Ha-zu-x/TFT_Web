/*



// Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
config.toolbar = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
	'/',
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
	{ name: 'others', items: [ '-' ] },
	{ name: 'about', items: [ 'About' ] }
];

// Toolbar groups configuration.
config.toolbarGroups = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
	{ name: 'forms' },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	{ name: 'links' },
	{ name: 'insert' },
	'/',
	{ name: 'styles' },
	{ name: 'colors' },
	{ name: 'tools' },
	{ name: 'others' },
	{ name: 'about' }
];


*/
CKEDITOR.editorConfig = function(config) {
    config.language = 'vi';
    config.entities = false;
    config.toolbar = [
        ['Source', '-', 'Bold', 'Italic', 'Underline', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'RemoveFormat', 'TextColor', 'BGColor', 'Font', 'FontSize'],
        ['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Subscript', 'Superscript', 'Blockquote', 'Image', 'Link', 'Unlink', 'Table', 'Maximize', 'ShowBlocks'],
        ['Styles', 'Format'],
    ];
    config.filebrowserImageUploadUrl = "/admin/ckeditor/plugins/iaupload.php";
    config.allowedContent = true;
    config.height = '450px';
    config.contentsCss = ['/css/bootstrap.min.css', '/css/ckeditor.css'];
    config.basicEntities = false;
    config.allowedContent = {
        script: true,
        $1: {
            // This will set the default set of elements
            elements: CKEDITOR.dtd,
            attributes: true,
            styles: true,
            classes: true
        }
    };

};

CKEDITOR.on('instanceReady', function(ev) {
    var editor = ev.editor,
        dataProcessor = editor.dataProcessor,
        htmlFilter = dataProcessor && dataProcessor.htmlFilter;

    // Out self closing tags the HTML4 way, like <br>.
    dataProcessor.writer.selfClosingEnd = '>';

    // Make output formatting behave similar to FCKeditor
    var dtd = CKEDITOR.dtd;
    for (var e in CKEDITOR.tools.extend({}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent)) {
        dataProcessor.writer.setRules(e, {
            indent: true,
            breakBeforeOpen: true,
            breakAfterOpen: false,
            breakBeforeClose: !dtd[e]['#'],
            breakAfterClose: true
        });
    }

    // Output properties as attributes, not styles.
    htmlFilter.addRules({
        elements: {
            $: function(element) {
                // Output dimensions of images as width and height
                if (element.name == 'img') {
                    var style = element.attributes.style;

                    if (style) {
                        // Get the width from the style.
                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                            width = match && match[1];

                        // Get the height from the style.
                        match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                        var height = match && match[1];

                        if (width) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                            element.attributes.width = width;
                        }

                        if (height) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                            element.attributes.height = height;
                        }
                    }
                }

                // Output alignment of paragraphs using align
                if (element.name == 'p') {
                    style = element.attributes.style;

                    if (style) {
                        // Get the align from the style.
                        match = /(?:^|\s)text-align\s*:\s*(\w*);/i.exec(style);
                        var align = match && match[1];

                        if (align) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)text-align\s*:\s*(\w*);?/i, '');
                            element.attributes.align = align;
                        }
                    }
                }

                if (!element.attributes.style)
                    delete element.attributes.style;

                return element;
            }
        },

        attributes: {
            style: function(value, element) {
                // Return #RGB for background and border colors
                return convertRGBToHex(value);
            }
        }
    });
});

/**
 * Convert a CSS rgb(R, G, B) color back to #RRGGBB format.
 * @param Css style string (can include more than one color
 * @return Converted css style.
 */
function convertRGBToHex(cssStyle) {
    return cssStyle.replace(/(?:rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\))/gi, function(match, red, green, blue) {
        red = parseInt(red, 10).toString(16);
        green = parseInt(green, 10).toString(16);
        blue = parseInt(blue, 10).toString(16);
        var color = [red, green, blue];

        // Add padding zeros if the hex value is less than 0x10.
        for (var i = 0; i < color.length; i++)
            color[i] = String('0' + color[i]).slice(-2);

        return '#' + color.join('');
    });
}
CKEDITOR.dtd.$removeEmpty.span = 0;
CKEDITOR.dtd.$removeEmpty.i = 0;