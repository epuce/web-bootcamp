### Other BE languages
* NodeJs
    * JavaScript based data handling engine
```ecmascript 6
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
# Look at the user that he could use your system like this
![Testers VS Users gif](img/testers-VS-users.gif)

* NoSQL data handling
    * MongoDB - JSON like structure
    ```mongodb
        
    ```
    * Others:
        * Cassandra - developed by Facebook, created for large data structuring
        * Redis - C language based, most used key-value store
        * HBase - Google developed, based on
        
### Checkup
* Create all the functionality for TODO statements under extra-resources/W07L04/
    * Create get/update/delete/ controller functions (user Postman for requests)
    * Create tests for successful and failed login and user delete