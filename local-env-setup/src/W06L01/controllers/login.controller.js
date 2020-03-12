const bcrypt = require('bcrypt');
const app = require('../app');

exports.login = function (request, response) {
	const sql = `SELECT * FROM users WHERE name='${request.body.name}'`;

	app.connection.query(sql, function (error, result) {
		if (error) throw error;

		bcrypt.compare(request.body.password, result[0].password, function(error, valid) {
			if (valid) {
				response.send('All good');
			} else {
				response.send('ERROR');
			}
		})
	});
};