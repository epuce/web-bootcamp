# ⚙️ other BE solutions

## Other BE languages

* NodeJs (JavaScript based data handling engine)
    ```javascript
    import express from 'express';                 // Node.js framework (ES modules)
    import userRoutes from './routes/user.route.js';

    const app = express();

    // Body parsing is built into Express now (no separate body-parser package)
    app.use(express.json());
    app.use(express.urlencoded({ extended: false }));

    app.use('/api/users', userRoutes);             // Mount the user routes

    const PORT = 8000;
    app.listen(PORT, () => {
        console.log(`Server is up and running on http://localhost:${PORT}`);
    });

    // "type": "module" in package.json enables import syntax; run: node app.js
    ```
* Others
    * Ruby
    * Java
    * Python
    * etc.

* Unit / API tests (the same idea applies across languages and frameworks)
    * JS - Node ships a built-in test runner (`node --test`), no extra library needed

```javascript
import { test, describe } from 'node:test';
import assert from 'node:assert/strict';

describe('Users', () => {
    test('should show a list of users', async () => {
        const res = await fetch('http://localhost:8000/api/users');
        const users = await res.json();

        assert.equal(res.status, 200);
        assert.ok(Array.isArray(users));
    });

    // Also write "negative" tests: logging in with bad data must fail
    test('rejects login with bad credentials', async () => {
        const res = await fetch('http://localhost:8000/api/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username: 'x', password: 'wrong' }),
        });
        assert.equal(res.status, 401);
    });
});
```

* NoSQL data handling
    * MongoDB - JSON like structure
    * Start the database server (in docker) - `mongod`
    * Start the MongoDB shell - `mongosh` (the old `mongo` shell is retired)
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
        * Cassandra - originally built at Facebook, now an Apache project, for very large distributed data
        * Redis - C-based, the most used in-memory key-value store (caching, queues, sessions)
        * HBase - Apache, modeled on Google's Bigtable, for huge sparse tables

> [!TIP]
> **Checkup**
>
> * Create CRUD functionality with nodejs
> * Create tests for successful and failed login and user delete