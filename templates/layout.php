<?php
if($isGuest) {
	require 'templates/guest.php';
} else {
	require 'templates/header.php';
}
require 'templates/footer.php';