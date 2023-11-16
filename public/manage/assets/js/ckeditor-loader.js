
// CKEditorローダ
window.addEventListener('DOMContentLoaded', function(event){
    document.querySelectorAll('[data-ckeditor]').forEach(elm=>ckeditor_load(<HTMLTextAreaElement>elm))
})

const allowedContentCommon = true;
// let allowedContentCommon =
// 	'div(*){*};'+
// 	'p(*){*};'+
// 	'span(*){*};'+
// 	'strong(*);'+
// 	'em(*);'+
// 	'u(*);'+
// 	's(*);'+
// 	'a(*)[!href];'+ // hrefが入ってないAタグは無視するという意味
// 	'img(*)[*];'+
// 	'table(*)[*];'+
// 	'thead(*)[*];'+
// 	'tbody(*)[*];'+
// 	'tfoot(*)[*];'+
// 	'tr(*)[*];'+
// 	'th(*)[*];'+
// 	'td(*)[*];'+
// 	'caption(*)[*];'+
// 	'ul(*);'+
// 	'ol(*);'+
// 	'li(*);'+
// 	'dl(*);'+
// 	'dt(*);'+
// 	'dd(*);'+
// 	'blockquote(*);'
// ;

function ckeditor_load(target: HTMLTextAreaElement)
{
    // 本文用（色、太字、画像アップロードなど）
    if ('content'===target.getAttribute('data-ckeditor')) {

        // PHP定義値の一部を、metaタグから取得する
        __SITE__ = <string>(<HTMLBaseElement>document.querySelector('meta[name="ashigaru:site"]')).getAttribute('content');
        __MANAGE__ = <string>(<HTMLBaseElement>document.querySelector('meta[name="ashigaru:manage"]')).getAttribute('content');
        __UPLOADS__ = <string>(<HTMLBaseElement>document.querySelector('meta[name="ashigaru:uploads"]')).getAttribute('content');

        let cke = CKEDITOR.replace(target,
            {
                allowedContent: allowedContentCommon,

                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,

                // width: 600,
                height: 350,

                // editor content css
                contentsCss: __SITE__+'/assets/css/ckeditor-content.css?20220912',
                bodyClass: 'page',
                // bodyId: document.querySelector('body.news')
                //     ? 'newsCo'
                //     : 'voiceCo'
                // ,

                // style set
                // stylesSet: 'my_styles',

                stylesSet: [
                    // { name: 'リード文', element: 'p', attributes: { class: 'p-txtUnit__txt' } },
                    { name: 'h3 見出し', element: 'h3' },
                    { name: 'h4 中見出し', element: 'h4' },
                    { name: 'h5 小見出し', element: 'h5' },
                    { name: 'p 段落', element: 'p' },
                ],

                font_names: 'ＭＳ Ｐゴシック;ＭＳ Ｐ明朝;ＭＳ ゴシック;ＭＳ 明朝;游ゴシック;游明朝;',

                // // icons
                // toolbarGroups: [
                // 	// { name: 'styles', groups: ['styles'] },
                // 	// { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
                // 	// { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                // 	// { name: 'forms',       groups: [ 'forms' ] },
                // 	{ name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                // 	{ name: 'colors', groups: ['colors'] },
                // 	// { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                // 	{ name: 'links', groups: ['links'] },
                // 	{ name: 'insert', groups: ['insert'] },
                // 	// { name: 'tools',       groups: [ 'tools' ] },
                // 	// { name: 'others',      groups: [ 'others' ] },
                // 	// { name: 'about',       groups: [ 'about' ] },
                // 	{ name: 'document', groups: ['mode', 'document', 'doctools'] }
                // ],

                toolbar: document.querySelector('body.news')
                    ? // お知らせ用
                    [
                        // ['Styles', 'Font', 'FontSize'],
                        ['Bold', 'Underline', 'Strike', 'RemoveFormat'],
                        ['JustifyLeft', 'JustifyCenter', 'JustifyRight'],
                        ['TextColor', 'BGColor'],
                        ['BulletedList', 'NumberedList'],
                        ['Link', 'Unlink'],
                        ['Image', 'Table'],
                        ['Source'],
                    ]
                    : // お客様の声用
                    [
                        // ['Styles', 'Font', 'FontSize'],
                        ['Styles'],
                        ['Bold', 'Underline', 'Strike', 'RemoveFormat'],
                        ['JustifyLeft', 'JustifyCenter', 'JustifyRight'],
                        ['TextColor', 'BGColor'],
                        ['BulletedList', 'NumberedList'],
                        ['Link', 'Unlink'],
                        ['Image', 'Table'],
                        ['Source'],
                    ],

                removeButtons: 'Templates,Save,NewPage,Preview,Print,Cut,Undo,Redo,Copy,Paste,PasteText,PasteFromWord,Find,SelectAll,Scayt,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CopyFormatting,Outdent,Indent,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Format,ShowBlocks,Maximize,About',

                // for KCFinder
                filebrowserBrowseUrl:      __MANAGE__+'/assets/kcfinder/browse.php?type=files',
                filebrowserImageBrowseUrl: __MANAGE__+'/assets/kcfinder/browse.php?type=images',
                filebrowserFlashBrowseUrl: __MANAGE__+'/assets/kcfinder/browse.php?type=flash',
                filebrowserUploadUrl:      __MANAGE__+'/assets/kcfinder/upload.php?type=files',
                filebrowserImageUploadUrl: __MANAGE__+'/assets/kcfinder/upload.php?type=images',
                filebrowserFlashUploadUrl: __MANAGE__+'/assets/kcfinder/upload.php?type=flash',
                filebrowserUploadMethod:   'form',

                // plugins
                extraPlugins: 'autogrow,widget,lineutils,image2,justify,colorbutton,font',
                removePlugins: 'image',

                // plugin: Auto Grow
                autoGrow_minHeight: 500,
                autoGrow_maxHeight: 500,
                autoGrow_bottomSpace: 50,

                // templates
                templates: 'default',
            })
        ;
        // フォーカスアウト時に自動的にValidon実行する関数
        cke.on('blur', function(e: any) {
            (<any>window).validon.send(e.editor.name)
        } );
        // textareaにデータを強制同期する関数を用意（フォーカス移さずにバリデートする直前に実行など）
        (<any>target)['ckeSync'] = function() {
            return this.value = cke.getData()
        }
    }
}
