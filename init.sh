#!/bin/bash

# Set the locale environment variable for sed (this ensures UTF-8 handling within sed)
export LC_ALL="en_US.UTF-8"

# Ask for the project name
read -p "Enter the project name: " project_name

# Sanitize the project name (replace spaces and special characters with dashes, and remove trailing dashes)
project_name_safe=$(echo "$project_name" | tr -cs '[:alnum:]' '-')
project_name_safe=$(echo "$project_name_safe" | sed 's/-$//')

# add a check if the current folder is in the mu-plugins folder
if [ ! -d "wpmvc-example" ]; then
  echo "The script must be run from the 'wpmvc-example' folder in the 'mu-plugins' directory."
  exit 1
fi

# Convert sanitized project name to lowercase for file name replacements
project_name_safe_lowercase=$(echo "$project_name_safe" | tr '[:upper:]' '[:lower:]')

# Verify the project name is not empty
if [ -z "$project_name" ]; then
  echo "Project name cannot be empty!"
  exit 1
fi

# Recursively find all files excluding init.sh and replace 'example-corp' with the sanitized project name (lowercase, dashes) in the content
find . -type f ! -name 'init.sh' -exec sed -i '' "s/example-corp/$project_name_safe_lowercase/g" {} \;

# Recursively find all files excluding init.sh and replace 'Example Corp' with the original project name (case preserved) in the content
find . -type f ! -name 'init.sh' -exec sed -i '' "s/Example Corp/$project_name/g" {} \;

# If `rename` is not available, use `mv` to rename files excluding init.sh
find . -type f -name '*example-corp*' ! -name 'init.sh' -exec bash -c '
  for file; do
    new_name=$(echo "$file" | sed "s/example-corp/'"$project_name_safe_lowercase"'/g")
    mv "$file" "$new_name"
  done
' bash {} +

# Move mu-boot-example.php to one folder lower and rename it to mu-boot-{project_name_safe_lowercase}.php
if [ -f "mu-boot-example.php" ]; then
  mv "mu-boot-example.php" "$(dirname "$(pwd)")/mu-boot-${project_name_safe_lowercase}.php"
  echo "Moved 'mu-boot-example.php' to one folder lower and renamed it to 'mu-boot-${project_name_safe_lowercase}.php'."
else
  echo "'mu-boot-example.php' file not found!"
fi

# Rename the main folder from "wpmvc-example" to the sanitized project name (lowercase)
current_folder_name=$(basename "$(pwd)")
if [ "$current_folder_name" == "wpmvc-example" ]; then
  mv "$(pwd)" "$(dirname "$(pwd)")/$project_name_safe_lowercase"
  echo "Renamed the main folder from 'wpmvc-example' to '$project_name_safe_lowercase'."
else
  echo "The main folder is not named 'wpmvc-example', skipping renaming."
fi

# Run composer install with the --ignore-platform-reqs flag
echo "Running 'composer install --ignore-platform-reqs'..."
composer install --ignore-platform-reqs

# Run composer update to update dependencies
echo "Running 'composer update'..."
composer update

# Run composer dump-autoload to optimize the autoloader
echo "Running 'composer dump-autoload'..."
composer dump-autoload

# Empty the README.md file and replace with default content
if [ -f "README.md" ]; then
  echo "Emptying the README.md file and adding default content..."
  echo "Add your project details like Installation details and Local setup" > README.md
else
  echo "README.md file not found!"
fi

# Check if all previous steps were successful before deleting the script
if [ $? -eq 0 ]; then
  # Delete this script (init.sh) if everything was successful
  echo "All steps executed successfully. Deleting the script..."
  rm -- "$0"
else
  echo "An error occurred. The script will not be deleted."
fi

# make sure you land in the current folder after the script is executed
cd "$(dirname "$(pwd)")/$project_name_safe_lowercase"

echo "All occurrences of 'example-corp' have been replaced with '$project_name_safe_lowercase' in file contents (lowercase, dashes), and 'Example Corp' with '$project_name' (case preserved), excluding init.sh. Also, file names have been updated excluding init.sh, the folder has been renamed, 'composer install', 'composer update', 'composer dump-autoload' executed, and the README.md file has been updated."
