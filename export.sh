#!/bin/bash

# Navigate to the deployment directory
cd /home/theshippinghack/testing.theshippinghack.com

# Extract the node_modules tarball
if [ -f node_modules.tar.gz ]; then
    echo "Extracting node_modules.tar.gz..."
    tar -xzf node_modules.tar.gz
    rm -f node_modules.tar.gz
    echo "Extraction completed!"
else
    echo "node_modules.tar.gz not found!"
fi
