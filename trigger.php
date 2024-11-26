<?php
// Path to your working directory
$workingDir = '/home/theshippinghack/testing.theshippinghack.com';

// Commands to set up the environment and start the app
$commands = [
    "export HOME=/home/theshippinghack", // Set HOME for PM2
    "cd $workingDir", // Navigate to the working directory
    "npm install", // Install dependencies
    "~/node/bin/pm2 delete theshipping || true", // Delete the existing process to avoid conflicts
    "~/node/bin/pm2 start theshipping.js --name theshippingh", // Start the app with a unique name
    "~/node/bin/pm2 save", // Save the PM2 process list
    "~/node/bin/pm2 startup | grep 'sudo' | bash" // Ensure PM2 starts on reboot
];

// Execute each command and capture the output
$output = "";
foreach ($commands as $command) {
    $result = shell_exec($command . " 2>&1");
    $output .= $result . "\n";
}

// Output the result for debugging
echo nl2br($output);
?>


