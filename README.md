# r2f2em - Simple json database with PHP
R2F2EM is a simple json database. It can be used with simple codes, without the need for any settings.
## Lets start

```php
include "r2f2em.php";
$a = new r2f2em("yourfile.json"); //Data will be kept in this file
```
OK. here we go. Now let's add some data and update it or call the data!
## methods
### add
If we want to add a data to our database, we just need to send this data as an array in the add method.
This method automatically adds an id value to every added data.
```php
$array = array(
"name"=>"John",
"surname"=>"His Surname",
"age"=>"32",
"country"=>"Germany"
);
echo $a->add($array); //This will return the id of this data we added last
```
Our json file will look like this after this process
```json
   {"sonid": "sonidDIGERVERILERLEKARISMASINDDJCEWUN1", "descriptionofdatabase": {"tr": {"aciklama": "Bu veritabanı, json formatında herkese açık bir veritabanıdır."}},  "id1": {"name":"John","surname":"His Surname","age":"32","country":"Germany"}}
```
### select
With this method, for example, we can return all rows whose name is John as an array.
```php
print_r($a->select("name", "John"));
```
Output
```php
Array ( [0] => stdClass Object ( [name] => John [surname] => His Surname [age] => 32 [country] => Germany ) )
```
### find
We can return all rows with name value as an array with find method.
In addition, the find method adds the id value to the row it finds in the database. Thus, since the id value of the reached row is known, we can use this id value in the update method for data update.
```php
print_r($a->find("name"));
```
Output
```php
Array ( [0] => stdClass Object ( [id] => id1 [name] => John [surname] => His Surname [age] => 32 [country] => Germany ) )
```
if we wanted to retrieve rows with "business" value, it would return blank because there is no row with this value in our database

### get
With get, we can get the data as an array based on the id number.
```php
print_r($a->get("id1"));
```
Output
```php
stdClass Object ( [name] => John [surname] => His Surname [age] => 32 [country] => Germany )
```
If the get value is empty, all data in the json database is returned as an array.
```php
print_r($a->get(""));
```
## update
With update, the data inside a row whose id value is known can be updated with a new data. The data to be sent should still be an array.
```php
$newarray = array(
"name"=>"John",
"lastname"=>"His Lastname",
"age"=>"35",
"country"=>"Germany"
);

$a->update("id1", $newarray);
```
Our json database is updated like this
```json
{"sonid": "sonidDIGERVERILERLEKARISMASINDDJCEWUN1", "descriptionofdatabase": {"tr": {"aciklama": "Bu veritabanı, json formatında herkese açık bir veritabanıdır."}},  "id1": {"name":"John","lastname":"His Lastname","age":"35","country":"Germany"}}
```
## drop
This method sets our database to default. So it's completely zero. Doesn't delete the json file.
```php
$a->drop();
```
