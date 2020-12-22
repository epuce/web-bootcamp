const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const user = require('./routes/user.route');
const login = require('./routes/login.route');

const app = express();

const PORT = 8002;

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));

const home = express.Router();
home.get('', (requset, response) => {
	response.sendFile('index.html', { root: __dirname })
});

app.use('*', home);

app.use('/api/users', user);
app.use('/api/login', login);
// app.use('/api/logout', logout);

const connection = mysql.createConnection({
	host: "localhost",
	port: 8082,
	user: "root",
	password: "root_password",
	database: "final-project"
});

connection.connect(function(error) {
	if (error) throw error;

	console.log("Connected!");
});


app.listen(PORT, () => {
	console.log('Server is up and running on localhost:' + PORT);
});

exports.connection = connection;
exports.PORT = PORT;