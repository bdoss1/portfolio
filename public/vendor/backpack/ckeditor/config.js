/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.extraPlugins = 'codesnippet';
    //
    config.codeSnippet_languages = {
        javascript: 'JavaScript',
        php: 'PHP',
        css: 'CSS',
        json: 'JSON',
        xml: 'HTML + XML'
    };

    config.codeSnippet_theme = 'atom-one-dark-reasonable';

    config.disableNativeSpellChecker = false;

};
