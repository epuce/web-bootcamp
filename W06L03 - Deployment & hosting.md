# 🚀 Deployment & hosting

Getting your app off `localhost` and onto a public URL other people can open. The same project runs
in more than one **environment** (local, maybe staging, production); the code is identical, only the
**configuration** changes.

## Configuration & secrets

* Read config from **environment variables**, not hard-coded values (DB host, passwords, API keys).
* Keep them in a `.env` file locally and **never commit it**, add `.env` to `.gitignore` and check in
  a `.env.example` with the keys but no real values.

```bash
# .env  (local, git-ignored)
DB_HOST=localhost
DB_PASSWORD=super-secret
```

* On the host, set the same variables through its dashboard or secret store. This is the
  "[12-factor](https://12factor.net/)" idea: config lives in the environment, not the code.

## Build step

* Front-end code is **built** before it ships: `npm run build` produces a `dist/` of minified,
  hashed static files. You deploy `dist/`, not the source.
* Back-end code (PHP/Node) ships as-is, but you run `composer install --no-dev` / `npm ci` on the
  server to install dependencies.

## Where to host

* **Static / front-end:** Netlify, Vercel, GitHub Pages, Cloudflare Pages, point them at the repo and
  they build and serve `dist/` on every push.
* **Back-end / full-stack (PaaS):** Render, Railway, Fly.io, you push, they build and run it. Least ops.
* **A server you manage (VPS):** DigitalOcean, Hetzner, a Linux box with **nginx** or **Apache** in
  front of your app. Most control, most responsibility (updates, security).
* **Containers:** ship the app as a Docker image to a registry and run it anywhere, this is what the
  course's own `docker-compose` setup previews.
* **Database:** use a **managed** MySQL/Postgres (the host's add-on) rather than a DB on the same box,
  so backups and updates are handled for you.

## HTTPS & domains

* Point a domain's DNS at the host. Serve over **HTTPS**, free certificates via **Let's Encrypt**
  (most PaaS/hosts do this automatically). No plain HTTP in production.

## Automate it: CI/CD

* **CI** (continuous integration) runs your tests on every push. **CD** (continuous deployment) ships
  it automatically when they pass. On GitHub this is **GitHub Actions** (`.github/workflows/*.yml`),
  the same mechanism this repo uses to regenerate its README.

```yaml
# .github/workflows/deploy.yml
name: deploy
on:
  push:
    branches: [main]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: actions/setup-node@v4
        with: { node-version: 22 }
      - run: npm ci
      - run: npm test
      - run: npm run build
      # then upload dist/ to your host, or let the host deploy on push
```

## After it is live

* Watch the **logs** (the host's log viewer) and add basic error monitoring (e.g. Sentry) so you hear
  about failures before your users do.
* Never deploy straight to production without the tests passing, that is what the pipeline is for.

> [!TIP]
> **Checkup**
>
> * Deploy your final project: front-end to a static host, the API + database to a PaaS, wired together
>   with environment variables, and add a GitHub Action that runs your tests on every push.
