### Databases and everything around them
1. Install mysql server locally
    * unix 
        - sudo apt-get install mysql-server
        - sudo mysql
        - ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'my_root_password';
        - mysql -u root -p
    * windows
        - [step by step instructions](https://mid.as/kb/00145/install-configure-mysql-on-windows)
        
2. Create a php file that manages the connection (database-wrapper.php)
3. Create a php file that executes the scripts
    * Create a database
    ```sql
    "CREATE DATABASE IF NOT EXISTS `web-bootcamp`"
    ```
    * USE db-name - on server to switch to the DB
    * Create database table
    ```sql
    CREATE TABLE Users
        (
            NAME varchar(20),
            PROFESSION varchar(20)
        );
    ```
4. SQL data types
    * Numeric
        * bit: 0 till 1
        * tinyint: 0 till 255
        * smallint: -32,768	till 32,767
        * int: -2,147,483,648 till 2,147,483,647
        * bigint: -9,223,372,036,854,775,808 till 9,223,372,036,854,775,807
        * decimal: -10^38 +1 till 10^38 -1
        * numeric: -10^38 +1 till 10^38 -1
        * float: -1.79E + 308 till 1.79E + 308
        * real: -3.40E + 38	till 3.40E + 38
    * Date/Time
        * DATE
        * TIME
        * DATETIME
        * TIMESTAMP
        * YEAR
    * Character/String
        * CHAR - exactly how many characters should that field be - till 8000
        * VARCHAR - the maximum text length - 8000
        * TEXT - max text store size 2GB
    * Binary
        * BINARY - exactly how long is the binary value - till 8000 bytes
        * VARBINARY - sets maximum length - till 8000 bytes
        * IMAGE - binary image file till 2GB of size
    * Miscellaneous
        * CLOB - similar to BLOB, just the charset reference is stored with it
        * BLOB - binary large objects
        * XML -stores xml data
        * JSON - stores JSON data
        
5. Creating/updating records
```sql
INSERT INTO TableName (column1, column2) VALUES (value1, value2, ...)
```
```sql
UPDATE TableName
SET column1 = value1, column2 = value2, ...
WHERE condition;
```
6. Retrieving records
    * All data from table
    ```sql
    SELECT * FROM Users
    ```
    
    * All data with conditions
    ```sql
    SELECT * FROM Users WHERE profession='Programmer'
    ```
    
    * Stated columns with conditions
    ```sql
    SELECT name FROM Users WHERE profession='Programmer'
    ```
6. Modify table
```sql
ALTER TABLE Users ADD (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
);
// OR
ALTER TABLE Users
DROP COLUMN name;
// OR
 ALTER TABLE Users 
 MODIFY profession varchar(30);
```
7. Joining tables
```sql
CREATE TABLE Purchases
    (
        time datetime,
        product varchar(20),
        id int NOT NULL AUTO_INCREMENT,
        userId int,
        PRIMARY KEY (id),
        FOREIGN KEY (userId) REFERENCES Users(id)
    );
```
8. Getting joined data - join types [link](http://www.sql-join.com/sql-join-types)
```sql
SELECT Users.name 
FROM Purchases INNER JOIN Users 
ON Purchases.userId=Users.id 
GROUP BY Users.name;
```

### Other commands
[SQL commands codeacademy](https://www.codecademy.com/articles/sql-commands)

[SQL commands w3school](https://www.w3schools.com/sql/default.asp)

### Checkup
Save all the scripts for further debugging
1. Create a new database
2. add 3 tables where two are joined together
3. Insert some data in all the tables
4. Write the fallowing scripts
    1. Get just some columns from a table
    2. Get data based on some conditions
    3. Get data from joined table
    4. Update a single record
    6. Add/remove/modify a table