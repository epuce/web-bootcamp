const app = require('../app');
const bcrypt = require('bcrypt');

exports.add = async(request, response) => {
    const data = request.body;

    const username = data.username;
    bcrypt.hash(data.password, 1, function(error, hash) {
        const password = hash;
        const sql = `INSERT INTO users (username, password) VALUES("${username}", "${password}")`;

        app.db.query(sql, (error, result) => {
            if (error) {
                console.log(error)
                response.send(JSON.stringify({
                    user_saved: false
                }))
                return;
            }
    
            response.send("test")
        })
    });
}

exports.list = (request, response) => {
    const sql = `SELECT * FROM users`;
    app.db.query(sql, (error, result) => {
        response.send(JSON.stringify(result))
    })
}
