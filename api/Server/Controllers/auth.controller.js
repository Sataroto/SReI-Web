const request = require('request');
const loger = {};

loger.buscar = (req, res) => {
    /*request({
        url: 'http://148.204.142.2/pump/web/index.php/login',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer 2001657889653220'
        },
        body: JSON.stringify({
            'username': req.body.username,
            'password': req.body.password
        })
    }, (err, rs, body) => {
        if(err) {
            console.error(err);
        } else {
            console.log(rs.statusCode, body);
        }
    });*/
}

module.exports = loger;
