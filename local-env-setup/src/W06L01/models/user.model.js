const bcrypt = require('bcrypt');

module.exports = class User {
	constructor(data) {
		this.name = data.name;
		this.profession = data.profession;
		this.password = data.password
	}

	getName() {
		return this.name;
	}

	getPassword() {
		return this.password;
	}

	getProfession() {
		return this.profession;
	}

	hashPassword() {
		hash = bcrypt.hash(this.password, 1, function (error, hash) {return hash});
		console.log(hash);

		return hash;
	}
};