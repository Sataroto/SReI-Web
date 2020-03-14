const express = require('express');
const morgan = require('morgan');
const cors = require('cors');
const app = express();

// Config
app.set('port', process.env.PORT || 3000);

// Midleware
app.use(morgan('dev'));
app.use(express.json());
app.use(cors({origin: 'http://localhost:8000'}));

// Rutas

// Servidor
app.listen(app.get('port'), () => {
    console.log('Servidor a la escucha en puerto: ', app.get('port'));
})
