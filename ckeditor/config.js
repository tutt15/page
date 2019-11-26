/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
CKEDITOR.editorConfig = function( config ) {
   config.toolbar = [
		{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
		{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
		{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
		'/',
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
		{ name: 'about', items: [ 'About' ] }
	];
   console.log(root_path);
   config.filebrowserBrowseUrl = '../ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = '../ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = '../ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = '../ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
   //config.filebrowserImageUploadUrl ='../ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = '../ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';

   config.extraPlugins = 'filebrowser';
   config.filebrowserBrowseUrl = '../ckeditor/kcfinder/browse.php';
   //config.filebrowserUploadUrl = '../ckeditor/kcfinder/upload.php';
   config.extraPlugins = 'uploadfile';

  // config.removePlugins = 'about,iframe,forms,checkbox,radio,textfield,textarea,select,button,imagebutton,hiddenfield,subscript,superscript';
   config.removePlugins = 'elementspath,save,flash,smiley,tabletools,pagebreak,about,maximize,showblocks,newpage,language';

   config.removeButtons = 'Copy,Cut,Paste,Undo,Redo,Print,Form,TextField,Textarea,Button,ImageButton,SelectAll,NumberedList,BulletedList,CreateDiv,PasteText,PasteFromWord,Select,HiddenField,Subscript,Superscript';
};
