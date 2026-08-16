import { test, before, after } from 'node:test';
import assert from 'node:assert/strict';
import { app } from '../app.js';

let server;
let baseUrl;

before(async () => {
  // Bind to an ephemeral port so tests never collide with a running server.
  await new Promise((resolve) => {
    server = app.listen(0, () => {
      const { port } = server.address();
      baseUrl = `http://127.0.0.1:${port}`;
      resolve();
    });
  });
});

after(async () => {
  await new Promise((resolve) => server.close(resolve));
});

test('GET /api/users returns 200 and an array', async () => {
  const res = await fetch(`${baseUrl}/api/users`);
  assert.equal(res.status, 200);
  const body = await res.json();
  assert.ok(Array.isArray(body), 'response body should be an array');
});

test('POST /api/users with a valid name returns 201 and a Location header', async () => {
  const res = await fetch(`${baseUrl}/api/users`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ name: 'Grace Hopper' }),
  });
  assert.equal(res.status, 201);
  const body = await res.json();
  assert.equal(body.name, 'Grace Hopper');
  assert.ok(typeof body.id === 'number', 'created user should have a numeric id');
  assert.equal(res.headers.get('location'), `/api/users/${body.id}`);
});

test('POST /api/users without a name returns 400', async () => {
  const res = await fetch(`${baseUrl}/api/users`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({}),
  });
  assert.equal(res.status, 400);
});

test('DELETE /api/users/:id for an unknown id returns 404', async () => {
  const res = await fetch(`${baseUrl}/api/users/999999`, { method: 'DELETE' });
  assert.equal(res.status, 404);
});
