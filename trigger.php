<?php
// Path to your working directory
$workingDir = '/home/theshippinghack/testing.theshippinghack.com';

// Run npm install and pm2 start
$output = shell_exec("cd $workingDir && npm install && pm2 start shipping.js 2>&1");

// Output the result
echo nl2br($output);
?>
