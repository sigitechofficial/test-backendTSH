name: CI/CD Workflow

on:
  push:
    branches:
      - testing # Automatically deploy on test branch
  workflow_dispatch: # Manually deploy on main branch

jobs:
  build:
    runs-on: ubuntu-latest
    container:
      image: node:16.14.0

    steps:
      - uses: actions/checkout@v2

      - name: Cache node modules
        uses: actions/cache@v2
        with:
          path: ~/.npm
          key: ${{ runner.os }}-node-${{ hashFiles('**/package-lock.json') }}
          restore-keys: |
            ${{ runner.os }}-node-
      - name: Install dependencies
        run: npm ci

      - name: Archive node_modules
        run: tar -czf node_modules.tar.gz node_modules

      - name: Upload node_modules artifact
        uses: actions/upload-artifact@v3
        with:
          name: node_modules
          path: node_modules.tar.gz

  deploy:
    needs: build
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v2

      - name: Download node_modules artifact
        uses: actions/download-artifact@v3
        with:
          name: node_modules

      - name: Extract node_modules locally before deployment
        run: |
          echo "Extracting node_modules.tar.gz locally..."
          tar -xzf node_modules.tar.gz
      - name: Transfer files to server
        uses: SamKirkland/FTP-Deploy-Action@v4.2.0
        with:
          server: ftp.theshippinghack.com
          username: ${{ secrets.TESTING_FTP_USERNAME }}
          password: ${{ secrets.TESTING_FTP_PASSWORD }}
          local-dir: ./ # Sync all files, including extracted node_modules directory

      - name: Verify deployment
        run: echo "Files successfully transferred to the server!"