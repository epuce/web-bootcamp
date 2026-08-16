import express from 'express';
import userRoutes from './routes/user.route.js';

export const app = express();

app.use(express.json());

app.use('/api/users', userRoutes);

// Start listening only when this module is run directly (e.g. `node app.js`),
// so tests can import `app` without a server port being bound.
const isMain = import.meta.url === `file://${process.argv[1]}`;
if (isMain) {
  const port = process.env.PORT || 3000;
  app.listen(port, () => {
    console.log(`Server listening on http://localhost:${port}`);
  });
}
