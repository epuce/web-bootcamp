// In-memory user store. No database required, so the app runs and tests
// pass without MySQL/Mongo. State lives for the lifetime of the process.

let users = [
  { id: 1, name: 'Ada Lovelace' },
  { id: 2, name: 'Alan Turing' },
];

let nextId = 3;

export function findAll() {
  return users;
}

export function findById(id) {
  return users.find((user) => user.id === id);
}

export function create({ name }) {
  const user = { id: nextId++, name };
  users.push(user);
  return user;
}

export function remove(id) {
  const index = users.findIndex((user) => user.id === id);
  if (index === -1) {
    return false;
  }
  users.splice(index, 1);
  return true;
}
