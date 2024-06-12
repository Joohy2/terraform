#!/bin/bash
FILE_PATH="/var/www/html/login.php"

if [ -f $FILE_PATH ]; then
  echo "Deleting existing file: $FILE_PATH"
  rm $FILE_PATH
fi
