import * as UserModel from '../models/user.model.js';

// GET /api/users
export function listUsers(req, res) {
  res.status(200).json(UserModel.findAll());
}

// GET /api/users/:id
export function getUser(req, res) {
  const id = Number(req.params.id);
  const user = UserModel.findById(id);
  if (!user) {
    res.status(404).json({ error: 'User not found' });
    return;
  }
  res.status(200).json(user);
}

// POST /api/users
export function createUser(req, res) {
  const name = req.body?.name;
  if (typeof name !== 'string' || name.trim() === '') {
    res.status(400).json({ error: 'A non-empty "name" is required' });
    return;
  }
  const user = UserModel.create({ name: name.trim() });
  res.status(201).location(`/api/users/${user.id}`).json(user);
}

// DELETE /api/users/:id
export function deleteUser(req, res) {
  const id = Number(req.params.id);
  const removed = UserModel.remove(id);
  if (!removed) {
    res.status(404).json({ error: 'User not found' });
    return;
  }
  res.status(204).end();
}
