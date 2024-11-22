<?php
// Path to your working directory
$workingDir = '/home/theshippinghack/testing.theshippinghack.com';

// Run npm install
$output = shell_exec("cd $workingDir && npm install 2>&1");

// Run pm2 start using its full path
$output .= shell_exec("cd $workingDir && ~/node/bin/pm2 start shipping.js 2>&1");

// Output the result
echo nl2br($output);
?>
