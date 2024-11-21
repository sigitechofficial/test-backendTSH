on:
  push:
    branches:
      - testing
      - main
  workflow_dispatch:

jobs:
  deploy:
    runs-on: ubuntu-latest

    steps:
      - name: Checkout code
        uses: actions/checkout@v2

      - name: Cache node modules
        uses: actions/cache@v2
        with:
          path: ~/.npm
          key: ${{ runner.os }}-node-${{ hashFiles('**/package-lock.json') }}
          restore-keys: |
            ${{ runner.os }}-node-

      - name: Install dependencies locally and compress
        run: |
          npm ci
          tar -czf node_modules.tar.gz node_modules

      - name: Deploy files including node_modules.tar.gz
        uses: SamKirkland/FTP-Deploy-Action@v4.2.0
        with:
          server: ftp.theshippinghack.com
          username: ${{ secrets.TESTING_FTP_USERNAME }}
          password: ${{ secrets.TESTING_FTP_PASSWORD }}
          local-dir: ./ # Upload all files in the current directory to the target server

      - name: Set execute permissions on extract.sh
        run: |
          echo "SITE CHMOD 777 /home/theshippinghack/testing.theshippinghack.com/extract.sh" > ftp_commands.txt
          lftp -u ${{ secrets.TESTING_FTP_USERNAME }},${{ secrets.TESTING_FTP_PASSWORD }} -e "open ftp.theshippinghack.com; source ftp_commands.txt; bye"

      - name: Execute extract.sh on server
        run: |
          echo "Running extract.sh script on the server..."
          lftp -u ${{ secrets.TESTING_FTP_USERNAME }},${{ secrets.TESTING_FTP_PASSWORD }} -e "open ftp.theshippinghack.com; cd /home/theshippinghack/testing.theshippinghack.com; !bash ./extract.sh; bye"
