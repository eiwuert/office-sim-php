<?php

$file = __DIR__ . '/' . 'data.txt';

$json = file_get_contents ($file);

$data = json_decode($json);

$data[] = array('title' => $_POST['title'], 'teaser' => $_POST['teaser']);

$encoded = json_encode($data);

file_put_contents ( $file, $encoded );

$url = 'http://' . $_POST['host'] . '/job_demo';

?>
<html>
<head>
</head>
<body>
<h1>Job Created!</h1>
<a href="<?php print $url; ?>" target="_parent">Return to Job List</a>
</body>
</html>