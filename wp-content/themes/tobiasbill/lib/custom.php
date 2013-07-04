<?php
/**
 * Custom functions
 */

//funktion som tar bort "Lösenordsskyddad:" från titeln Delivery web
add_filter('protected_title_format', 'blank');
function blank($title) {
       return '%s';
}

