import { Router } from 'express';
import {
  listUsers,
  getUser,
  createUser,
  deleteUser,
} from '../controllers/user.controller.js';

const router = Router();

router.get('/', listUsers);
router.get('/:id', getUser);
router.post('/', createUser);
router.delete('/:id', deleteUser);

export default router;
