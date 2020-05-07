const express = require('express');
const router = express.Router();
const loger = require('../Controllers/auth.controller');

router.post('/', loger.buscar);

module.exports = router;
