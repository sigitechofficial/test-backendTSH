<?php
// Path to your working directory
$workingDir = '/home/theshippinghack/testing.theshippinghack.com';

// Set HOME environment variable and run commands
$commands = [
    "export HOME=/home/theshippinghack", // Set the HOME environment
    "cd $workingDir", // Navigate to the working directory
    "npm install", // Install dependencies
    "~/node/bin/pm2 start theshipping.js || ~/node/bin/pm2 restart theshipping.js", // Start or restart the PM2 process
    "~/node/bin/pm2 save" // Save the PM2 process list
];

$output = "";
foreach ($commands as $command) {
    $result = shell_exec($command . " 2>&1");
    $output .= $result . "\n";
}

// Output the result
echo nl2br($output);
?>
