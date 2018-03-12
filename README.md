# vadiasov/ordering
Laravel package to order rows of DB table by 'drug and drop'.

## Goals
1. Create ordering of given rows of DB table and save ordering in the same table.
2. Ordering is made by Drug and Drop technology.

## Workflow
1. Parent page has set of rows.
2. Row has column 'order' (or other with the same sense).
3. Parent page has button "Order".
4. After clicking on the button "Order" page "Ordering" is open (child page).
5. Making of ordering.
6. Child page has button "Save and back".
7. Clicking on the button "Save and back" leads to parent page.

## Config of parent page
* Column name of "order" column
* DB table name
* Array of columns that are shown in the child page
* Title of "Save and back" button.

Example:
````
<?php

return [
    'order'          => 'order',
    'db_table'       => 'tracks',
    'fields_to_show' => ['order', 'title', 'file'],
    'buton_title'    => 'Save and back',
    'box_title'      => 'Tracks of Album ',
];
````

## Using
Parent page has button "Order" with href 
````
/ordering/{config_name}
````

## Installation
1.Create row in the application root composer:
````
"require": {
      ...
        "vadiasov/ordering": "^0.1.1",
      ...  
    },
````
2.Run in your terminal:
````
cd your_application_root
composer update
````
3.This package is developed with discovery feature. So it must itself to create row in a config/app.com about ServiceProvider:
````
/*
 * Package Service Providers...
 */
...
Vadiasov\Ordering\OrderingServiceProvider::class,
````
4.Edit config file that you will use in outer controller to start upload (for example: config/tracks.php):



