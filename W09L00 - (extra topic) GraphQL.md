## GraphQL

A query language for APIs and a runtime that fulfils those queries. Instead of many REST endpoints,
GraphQL exposes a **single endpoint** and a **typed schema**; the client asks for exactly the fields
it needs and gets back exactly that shape in one request.

### GraphQL vs REST
* REST: many endpoints (`/users`, `/users/1/posts`), the **server** decides the response shape,
  over- and under-fetching are common.
* GraphQL: one endpoint (`/graphql`), the **client** decides the shape, strongly typed and
  introspectable.
* Trade-offs: GraphQL moves complexity to the server (resolvers, the N+1 query problem, caching is
  harder than plain HTTP caching); REST stays simpler and CDN-cache friendly. Pick per use case.

### The schema (SDL)
```graphql
type Country {
  name: String!
  currency: String!
  population: Int!
}

type Query {
  countries(currency: String!): [Country!]!
}

type Mutation {
  addFavourite(name: String!): Country!
}
```
* `!` means non-null; `[Country!]!` is a non-null list of non-null countries.

### A query and a mutation
```graphql
query {
  countries(currency: "usd") {
    name
    population
  }
}

mutation {
  addFavourite(name: "Latvia") {
    name
  }
}
```

### A modern server (Node) — graphql-yoga
```bash
npm install graphql-yoga graphql
```
```js
import { createServer } from 'node:http';
import { createYoga, createSchema } from 'graphql-yoga';

const yoga = createYoga({
  schema: createSchema({
    typeDefs: /* GraphQL */ `
      type Query { hello: String! }
    `,
    resolvers: {
      Query: { hello: () => 'Hello from GraphQL' },
    },
  }),
});

createServer(yoga).listen(4000, () => console.log('http://localhost:4000/graphql'));
```
* Apollo Server 4 is the other common choice. Both ship a built-in GraphiQL playground at the endpoint.

### Calling it from the client
No special library needed, it is just a `POST`:
```js
const res = await fetch('http://localhost:4000/graphql', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    query: 'query ($c: String!) { countries(currency: $c) { name } }',
    variables: { c: 'usd' },
  }),
});
const { data } = await res.json();
```
For real apps use a client that adds caching, normalisation and framework bindings:
**Apollo Client**, **urql**, or **TanStack Query** over a small fetch wrapper.

### When to reach for it
* Multiple clients (web, mobile) each needing a different slice of the same data.
* A fast-moving front-end where you do not want to redeploy the API for every shape change.
* A large graph of related entities. For a small CRUD app, REST is usually less overhead.

### More
* [Official docs](https://graphql.org/learn/)
* [graphql-yoga](https://the-guild.dev/graphql/yoga-server)
* [Apollo Server](https://www.apollographql.com/docs/apollo-server/)
