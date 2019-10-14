/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
CKEDITOR.editorConfig = function( config ) {
   console.log(root_path);
   config.filebrowserBrowseUrl = '../ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = '../ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = '../ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = '../ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl ='../ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = '../ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';

   config.extraPlugins = 'filebrowser';
   config.filebrowserBrowseUrl = '../ckeditor/kcfinder/browse.php';
   config.filebrowserUploadUrl = '../ckeditor/kcfinder/upload.php';

};
