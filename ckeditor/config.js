/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	
   config.filebrowserBrowseUrl = 'http://localhost/page-master/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = 'http://localhost/page-master/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = 'http://localhost/page-master/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = 'http://localhost/page-master/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = 'http://localhost/page-master/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = 'http://localhost/page-master/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';

   config.extraPlugins = 'filebrowser';
   config.filebrowserBrowseUrl = 'http://localhost/page-master/ckeditor/kcfinder/browse.php';
   config.filebrowserUploadUrl = 'http://localhost/page-master/ckeditor/kcfinder/upload.php';

};
