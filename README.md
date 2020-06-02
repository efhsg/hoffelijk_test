## Technical configuration

- To have a quick development setup, I chose to use Laravel in a prefab Docker image.  
Setup project:
```
cd $PROJECTHOME && docker run -ti --rm -v $(pwd):/var/www lorisleiva/laravel-docker /bin/bash -c "composer create-project --prefer-dist laravel/laravel hoffelijk_test"  
```
Start web server:
```
cd $PROJECTHOME/hoffelijk_test && docker run -ti --rm -p 80:8000 -v $(pwd):/var/www lorisleiva/laravel-docker /bin/bash -c "php artisan serve --host 0.0.0.0"
```
Choosing and setting up the development environment took about an hour.

## Upload and parse excel sheet 
- Form with some basic validation to upload the exam, URL: ./exam/upload  
Files are stored in ./public/upload

Took about an hour. More than expected, due to not having worked with Laravel for a year or 2.

- Parse excel sheet
Used [cyber-duck](https://packagist.org/packages/cyber-duck/laravel-excel) to parse the Excel sheet
The actual parsing is done in the namespace Domain. A new instance gets created in the controller. In a more complex domain an interface with dependency injection would be better.

TODO: validation, error handling, unit tests.

## Calculations

All calculations are done in Domain/Exam.php
Took more time than expected by lack of practice.

TODO: unit tests.

## Analytics
Not implemented.
