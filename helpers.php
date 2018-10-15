<?php
function san($dirty){
	return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function display_errors($errors){
	$display = '<ul class="bg-danger">';
	foreach($errors as $error){
		$display .= '<li class="">'.$error.'</li>' ;
	}
	$display .= '</ul>';
	return $display;
}
function display_success($success){
	$display = '<ul class="bg-success">';
	foreach($errors as $error){
		$display .= '<li class="">'.$success.'</li>' ;
	}
	$display .= '</ul>';
	return $display;
}
?>