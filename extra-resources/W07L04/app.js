const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const user = require('./routes/user.route');
const login = require('./routes/login.route');

const app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));

app.use('/api/users', user);
app.use('/api/login', login);
//app.use('/api/logout', logout);

const connection = mysql.createConnection({
	host: "104.248.125.41",
	user: "root",
	password: "root_password",
	database: "web-bootcamp"
});

connection.connect(function(error) {
	if (error) throw error;

	console.log("Connected!");
});

exports.connection = connection;

app.listen(8000, () => {
	console.log('Server is up and running on localhost:' + 8000);
});