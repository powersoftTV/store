/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'ru';
	 config.height = 1000;
	 config.weight = 1000;
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = 'ckeditor/plugins/elfinder/elfinder.html';
	config.removePlugins = 'forms';
	config.extraPlugins = 'youtube';
	config.youtube_privacy = false;
	config.youtube_related = false;
	config.youtube_language = 'ru';
};
