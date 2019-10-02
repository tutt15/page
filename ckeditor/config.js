/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
CKEDITOR.editorConfig = function( config ) {
   console.log(root_path);
   config.filebrowserBrowseUrl = root_path +'/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = root_path +'/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = root_path +'/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = root_path +'/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = root_path +'/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = root_path +'/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';

   config.extraPlugins = 'filebrowser';
   config.filebrowserBrowseUrl = root_path +'/ckeditor/kcfinder/browse.php';
   config.filebrowserUploadUrl = root_path +'/ckeditor/kcfinder/upload.php';

};
