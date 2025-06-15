import React from 'react';
import ReactDOM from 'react-dom/client';
import ExampleSideBar from './Example/TestSideBar';
import '../scss/app.scss'

const element = document.getElementById('react-root');
const root = ReactDOM.createRoot(element);
root.render(<ExampleSideBar></ExampleSideBar>);

