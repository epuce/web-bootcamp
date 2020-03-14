const User = require('../models/user.model');
const app = require('../app');

exports.list = function (request, response) {
	const sql = "SELECT * FROM users";

	app.connection.query(sql, function (error, result) {
		if (error) throw error;

		response.send(JSON.stringify(result));
	});
};

exports.add = function (request, response) {
	console.log(request.body)

	let user = new User(request.body);
	user.hashPassword().then((hash) => {
		console.log(hash)
	})

	const sql = `INSERT INTO users (name, password) VALUES ("${user.getName()}", "${user.getPassword()}")`;

	app.connection.query(sql, function (error, result) {
		if (error) throw error;

		app.connection.query("SELECT * FROM users ORDER BY ID DESC LIMIT 1", function (err, res) {
			if (err) throw err;

			response.send(JSON.stringify(res));
		})
	});
};

exports.get = function (request, response) {
	// TODO create the get functionality
	response.send('get');
};

exports.update = function (request, response) {
	// TODO create the update functionality
	response.send('update');

};

exports.delete = function (request, response) {
	// TODO create the delete functionality
	response.send('delete');
};