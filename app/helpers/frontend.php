<?php
/*
|--------------------------------------------------------------------------
| Register custom macros
|--------------------------------------------------------------------------
|
| Register custom macros for blade view.
*/

/**
* Macro untuk membuat divider
* @return string html
*/
HTML::macro('divider', function() {
	return "<hr class=\"uk-article-divider\">";
});

/**
* Macro for UIKIT label
* @return string html
*/
Form::macro('labelUk', function($name, $placeholder) {
	return Form::label($name, $placeholder, array('class' => 'uk-form-label'));
});

/**
* Macro for UIKIT text
* @return string html
*/
Form::macro('textUk', function($name, $placeholder = null, $icon = null) {
	$html = '';
	if ($icon) {
		$html .= "<div class=\"uk-form-icon\">
		<i class=\"$icon\"></i>";
	} else {
		$html .= "<div class=\"uk-form-controls\">";
	}

	$html .= Form::text($name, null, array('placeholder'=>$placeholder));
	$html .= '</div>';

	return $html;
});

/**
* Macro untuk menampilkan tombol submit
* @return string html
*/
Form::macro('submitUk', function($title) {
	return "<input type=\"submit\" value=\"$title\" class=\"uk-button uk-button-primary\">";
});

