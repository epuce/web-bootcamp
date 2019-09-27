const User = require('../models/user.model');
const app = require('../app');

exports.list = function (request, response) {
	const sql = "SELECT * FROM Users";

	app.connection.query(sql, function (error, result) {
		if (error) throw error;

		response.send(JSON.stringify(result));
	});
};

exports.add = function (request, response) {
	console.log(request.body)

	const user = new User(request.body);
	const sql = `INSERT INTO Users (name, profession, password) VALUES ("${user.getName()}", "${user.getProfession()}", "${user.getPassword()}")`;

	app.connection.query(sql, function (error, result) {
		if (error) throw error;

		app.connection.query("SELECT * FROM Users ORDER BY ID DESC LIMIT 1", function (err, res) {
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