import { useState } from 'react';

function App() {
  const [count, setCount] = useState(0);

  return (
    <div>
      <h1>You have clicked {count} times</h1>
      <button onClick={() => setCount(count + 1)}>Add one</button>
    </div>
  );
}

export default App;
