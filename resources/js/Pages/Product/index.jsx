import React from 'react';
import { createRoot } from 'react-dom/client';  

const reactComponents = document.querySelectorAll('[data-react-component]');

reactComponents.forEach(async (element) => {
    const componentName = element.getAttribute('data-react-component');
   
    const componentPath = `./${componentName}.jsx`;
    try {
        
        const module = await import(componentPath);
        const Component = module.default;
        
        const root = createRoot(element);
        root.render(<Component />);

    } catch (error) {
        console.error(`Error loading component ${componentName}:`, error);
    }

})
