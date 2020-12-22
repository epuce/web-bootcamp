const express = require('express');
const mysql = require('mysql');
const cors = require('cors');
const bodyParser = require('body-parser')
const userRoutes = require('./routes/user.route');
const mongodb = require('mongodb').MongoClient;

const app = new express();
app.use(cors());
// app.use(bodyParser.json());
// app.use(bodyParser.urlencoded({extended: true}))

const router = express.Router();

router.get('', (reject, response) => {
    console.log('Response was sent to the browser');
    response.send("Requested route does not exist");
})

const mongoRouter = express.Router();
mongoRouter.get('', (request, response) => {
    mongodb.connect('mongodb://root:root_password@localhost:27017', (err, db) => {
        if (err) {
            console.log(err)
        }

        const dbInstance = db.db('shop');

        const product = {
            name: "Cool book",
            category: "books"    
        }
        const product1 = {
            name: "Steel",
            category: "books",
            pages: 300,    
        }
        const product2 = {
            name: "Lord of the Rings",
            categry: "books",
            pages: 500,       
        }

        dbInstance.collection("products").insertMany([product, product1, product2], (err, res) => {
            if (err) {
                console.log(err);
            }
        })

        dbInstance.collection("products").find({
            pages: 500
        }, (err, res) => {
            if (err) err;

            res.toArray().then((data) => {
                response.send(data);
            })
        })
    })
    
})

app.use('/mongo', mongoRouter);
app.use('/users', userRoutes);
app.use('*', router);

const db = mysql.createConnection({
    host: 'localhost',
    port: '8082',
    user: 'root',
    password: 'root_password',
    database: 'shop'
})

db.connect((error) => {
    console.log("Connected to database")
})

app.listen(8002, () => {
    console.log('Server is up on http://localhost:8002')
})

exports.db = db;