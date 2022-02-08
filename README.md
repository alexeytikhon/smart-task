**Smart-task**

This script implements a console command that gets data from the log file and outputs them in a structured form.

The script is implemented on the Lumen framework and uses its tools to work with the CLI.

Required PHP version : **7.3+**

**Installation steps:**

1) Load necessary dependencies via composer - `composer install` at project's root
2) Create `.env` file at the root of the project with content similar to `.env.example`

**Command execution:**

Command receives `filename` as param - path to file on your env

`php artisan log:parse {filename}` 

**Running tests:**

`php vendor/bin/codecept run` from project's root
