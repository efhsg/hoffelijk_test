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

## Upload and parse excel sheet 


## Calculations
