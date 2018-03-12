# Specification
## Goals
1. Create ordering of given rows of DB table and save it the same table.
2. Ordering is made by Drug and Drop technology.

## Workflow
1. Parent page has set of rows.
2. Row has column order (or other with the same sense).
3. Parent page has button "Order".
4. After clicking on button "Order" page "Ordering" is open (child page).
5. Making of ordering.
6. Child page has button "Save and back".
7. Click on the button "Save and back" leads to parent page.

## Config
* Column name of "order" column
* DB table name
* Array of columns that are shown in the child page
* Title of "Save and back" button.

## Using
Parent page has button "Order" with href 
````
/ordering/config_name
````