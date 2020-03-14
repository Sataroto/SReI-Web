const http = require('http');

function getJSON(option, cb) {
    http.request(options, (res) => {
        const header = {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer 2001657889653220'
        };

        const body = {
            'username': '2018671281',
            'password': 'pokemon502'
        };

        res.on('data', (chunk) => {
            body += chunk;
        });

        res.on('end', () => {
            const boleta = JSON.parse(body);
            console.log(boleta);
        });

        res.on('error', cb);
    })
    .on('error', cb)
    .end();
}

var options = {
    'host': 'http://148.204.142.2/pump/web/index.php/login',
    'method': 'POST'
};



getJSON(options, (err, res) => {
    if(err) {
        return console.log('Error en la consulta');
    }

    console.log(res)
});
    
