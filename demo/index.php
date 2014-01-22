<!DOCTYPE html>
<html>
<head>
  <title>Myna PHP Demo</title>
</head>
<body>
  <h1>Myna PHP Demo</h1>
<?php
require_once '../src/autoload.php';

// Turn on logging
\Myna\Log::$enabled = true;

$experimentId = '8ebfeab2-c308-413f-93ff-45beb603949a';
$deploymentUuid = 'ae15f7c0-df1f-11e2-bfc7-7c6d628b25f7';
$client = \Myna\Myna::init($deploymentUuid);
$suggestion = $client->suggest($experimentId);

echo "<p>Suggestion is {$suggestion->name}</p>";
?>
</body>
</html>
