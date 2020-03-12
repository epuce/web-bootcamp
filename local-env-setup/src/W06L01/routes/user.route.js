const express = require('express');
const router = express.Router();

const user_controller = require('../controllers/user.controller');

router.get('/list', user_controller.list);

router.post('/add',  user_controller.add);

router.get('/:id', user_controller.get);

router.put('/:id', user_controller.update);

router.delete('/:id', user_controller.delete);

module.exports = router;