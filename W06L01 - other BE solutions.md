### Other BE languages
* NodeJs (JavaScript based data handling engine)
    ```javascript
    const express = require('express'); // NodeJs framework
    const bodyParser = require('body-parser'); // Request / Response data parser

    const user = require('./routes/user.route'); // For API routing (user created)

    const app = express(); // Create new app

    // Setup the data parser
    app.use(bodyParser.json());
    app.use(bodyParser.urlencoded({extended: false}));

    app.use('/api/users', user);// Add specific API routing for user

    // Create the NodeJs server
    app.listen(8000, () => {
        console.log('Server is up and running on localhost:' + 8000);
    });

    // run node app.js in the terminal to start the app
    ```
* Others
    * Ruby
    * Java
    * Python
    * etc.

* Unit tests (can be applied for almost all structures/languages/frameworks)
    * JS
```javascript
// can be 
require('should'); // For testing data validity
const http = require('http'); // For communicating with the server

// Describe the data that will be tested
describe('Users', () => {

    // Add the test description that is corresponding to the descriptions
	it('should show list of users', (done) => {
        // The test checking data validity is added here
        // You have to call done()  as the callback for the test to finish
		done();
	});
    
    // Test all needed functionality
	it('should create an user', (done) => {
        // The test checking data validity is added here
        // You have to call done()  as the callback for the test to finish
		done();
	});

    // A good practise is to add false positive tests
    // Example: when user adds false data for login, the login does not happen 
});
```

* NoSQL data handling
    * MongoDB - JSON like structure
    * Start the database server (in docker) - `mongod`
    * Start the MongoDB shell - `mongo`
    * Create database - `use your-db-name`
    * Create database table - `db.createCollection("users")`
    * [All commands](https://docs.mongodb.com/manual/reference/method/js-collection/)
    ```javascript
        db.users.insertMany([{name: "Ed", profession: "Programmer"}, {name: "Jim", age: 10}])
        db.users.find({}) // Get all
        db.users.find({name: "Ed"}); // Get all with condition
        db.users.findOneAndUpdate(
              { "name" : "Ed" },
              { $set: { "name" : "Alex", new_field: "Value of new field"}
        );  
    ```
    * Others:
        * Cassandra - developed by Facebook, created for large data structuring
        * Redis - C language based, most used key-value store
        * HBase - Google developed, based on
        
### Checkup
* Create CRUD functionality with nodejs
* Create tests for successful and failed login and user delete