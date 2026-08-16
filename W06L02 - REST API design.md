# 🔌 REST API design

REST is a style for building HTTP APIs around **resources** (things: users, products, orders). The
URL names the resource, the HTTP method says what to do with it, and the server stays **stateless**,
each request carries everything it needs (usually a token). This lesson is the conventions layer on
top of the Node/Express and PHP backends from the previous lessons.

## Resources & URLs

* Name resources with **plural nouns**, not verbs: `/products`, not `/getProducts`.
* Nest to show relationships: `/users/42/orders`.
* Keep filtering, sorting and paging in the **query string**: `/products?category=phones&sort=price&page=2`.

## HTTP methods (the verbs)

| Method | Use | Idempotent? |
|--------|-----|-------------|
| GET | read a resource / list | yes |
| POST | create a new resource | no |
| PUT | replace a resource whole | yes |
| PATCH | update part of a resource | no |
| DELETE | remove a resource | yes |

* *Idempotent* = calling it twice has the same effect as once. GET/PUT/DELETE should be; POST is not
  (two POSTs create two rows).

## Status codes (say what happened)

* `200 OK`, `201 Created` (+ a `Location` header), `204 No Content` (deleted, nothing to return).
* `400 Bad Request` (validation failed), `401 Unauthorized` (not logged in), `403 Forbidden`
  (logged in, not allowed), `404 Not Found`, `409 Conflict` (duplicate).
* `500 Internal Server Error` (a bug on the server, never for user mistakes).

## Request & response bodies

* Talk JSON: set `Content-Type: application/json` and parse it (`express.json()` in Express, PDO +
  `json_encode()` in PHP).
* Return a **consistent shape**, and a predictable error shape so the client can branch on it:

```json
// 400 response
{ "error": "Validation failed", "code": "validation_error", "fields": { "email": "required" } }
```

## A small Express example

```js
import express from 'express';

const app = express();
app.use(express.json());

// GET /products?limit=10
app.get('/products', async (req, res) => {
  const limit = Number(req.query.limit ?? 20);
  const products = await db.listProducts(limit);
  res.json(products);
});

// POST /products
app.post('/products', async (req, res) => {
  const { name, price } = req.body;
  if (!name) {
    return res.status(400).json({ error: 'name is required', code: 'validation_error' });
  }
  const product = await db.createProduct({ name, price });
  res.status(201).location(`/products/${product.id}`).json(product);
});

app.listen(3000);
```

## The rest of the checklist

* **Auth:** send a token in `Authorization: Bearer <token>`; never in the URL.
* **CORS:** a browser on another origin needs the server to allow it (the `cors` middleware, or
  `Access-Control-Allow-Origin`).
* **Validation:** validate every input server-side (zod / a validation lib on Node, typed checks in
  PHP). Never trust the client.
* **Versioning:** when you must break the shape, version it (`/api/v2/...`) instead of breaking
  existing clients.

## Tools

* Try requests with **curl**, **Postman** or **Insomnia** (or the browser for GETs).
* Describe the API with **OpenAPI / Swagger** so it is documented and testable.

> [!TIP]
> **Checkup**
>
> * Take your final-project backend and make its endpoints follow these rules: plural nouns, the right
>   method per action, correct status codes, and a consistent JSON error shape.
