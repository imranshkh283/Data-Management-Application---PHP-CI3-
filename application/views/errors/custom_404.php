<!DOCTYPE html>
<html>

<head>
	<title><?= $title ?? '404 - Page Not Found' ?></title>
</head>

<body>
	<h1>Oops! Page Not Found (404)</h1>
	<p>Sorry, the page you are looking for does not exist.</p>
	<a href="<?= base_url(); ?>">Back to Home</a>
</body>

</html>