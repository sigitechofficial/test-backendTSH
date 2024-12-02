<?php
// Path to your working directory
$workingDir = '/home/theshippinghack/testing.theshippinghack.com';

// Set up the correct environment variables for the shell
$nodeBinPath = '/home/theshippinghack/node/bin';  // Path to node binaries

// Set the PATH environment variable explicitly using putenv()
putenv("PATH=$nodeBinPath:" . getenv('PATH'));  // Prepend nodeBinPath to system PATH

// Run the npm install and pm2 start with the shell command
$command = "export HOME=/home/theshippinghack && cd $workingDir && npm install && pm2 start shipping.js --name rauf 2>&1";

// Execute the command
$output = shell_exec($command);

// Check if output is null
if ($output === null) {
    $output = "No output returned from shell command.";
}

// Output the result
echo nl2br($output);
?>
