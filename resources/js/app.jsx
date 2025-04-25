import React from 'react';
import ReactDOM from 'react-dom/client';
import Example from './Components/Example';

const el = document.getElementById('react-root');

if (el) {
    const root = ReactDOM.createRoot(el);
    root.render(<Example />);
}
