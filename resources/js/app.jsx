import React from 'react';
import ReactDOM from 'react-dom/client';
import Example from './Components/Example';


const reactElements = document.querySelectorAll('[data-react]');

reactElements.forEach(async (element) =>{
    const component = element.data.react;
    const module = await import(`./Pages/${element.dataset.react}`);
})
