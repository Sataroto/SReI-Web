const mongoose = require('mongoose');
const uri = 'mongodb://localhost/SReI';

mongoose.connect(uri,{
    useNewUrlParser: true,
    useUnifiedTopology: true,
    useFindAndModify: false
})
    .then(db => console.log('Base de datos conectada'))
    .catch(err => console.error(err));

module.exports = mongoose;
