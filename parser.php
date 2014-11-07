<?php
	if (isset($_GET['url']) && isset($_GET['callback'])) {

		$token = '';

		header('Content-Type: application/json');
		print file_get_contents('https://www.readability.com/api/content/v1/parser?url='.urlencode($_GET['url']).'&token='.$token.'&callback='.$_GET['callback']);
	}
?>