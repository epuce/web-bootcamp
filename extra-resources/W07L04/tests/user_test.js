require('should');
const http = require('http');
const querystring = require('querystring');

describe('Users', () => {
	const options = {
		host: 'localhost',
		port: '8000',
		path: '/api/users/list',
		method: 'GET',
		headers: {
			'Content-Type': 'application/json',
		}
	};

	it('should show list of users', (done) => {
		const requestData = {
			...options,
			method: 'GET',
			path: '/api/users/list',
		};

		const request = http.request(requestData, function(fullResponse) {
			fullResponse.setEncoding('utf8');
			fullResponse.on('data', function (data) {
				data = data && JSON.parse(data);
				data.should.be.Array();
			});

			done();
		});

		request.end();
	});

	it('should create an user', (done) => {
		const requestBody = {
			name: "puce.eee",
			password: "password",
			profession: "test profession"
		};

		const requestData = {
			...options,
			method: 'POST',
			path: '/api/users/add',
			json: true,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
				'Content-Length': Buffer.byteLength(querystring.stringify(requestBody))
			}
		};

		const request = http.request(requestData, function(fullResponse) {
			fullResponse.setEncoding('utf8');
			fullResponse.on('data', function (data) {
				data = data && JSON.parse(data);

				data.should.be.Array();

				if (data.length === 1) {
					data[0].name.should.be.equal(requestBody.name);
					data[0].password.should.be.equal(requestBody.password);
					data[0].profession.should.be.equal(requestBody.profession);
				}

				done();
			});
		});

		request.write(querystring.stringify(requestBody));
		request.end();
	});

	it('should delete user', (done) => {
		// TODO create the test
	});

	it('should login', (done) => {
		// TODO create the test
	});

	it('should NOT login', (done) => {
		// TODO create the test
	});
});