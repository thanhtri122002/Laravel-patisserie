import React from 'react';
import { createRoot } from 'react-dom/client';  

/**
 * When using the dynamic
 */
const modules = import.meta.glob(['../Pages/Product/*.jsx', '../Components/*.jsx']);

const reactComponents = document.querySelectorAll('[react-component]');

reactComponents.forEach(async (element) => {
    const componentName = element.getAttribute('react-component');
    
    const paths = Object.keys(modules);
    
    const path = paths.find((p) => p.endsWith(`/${componentName}.jsx`));
    
    try {
        const module = await modules[path]();
        const Component = module.default;
        const root = createRoot(element);
        root.render(<Component />);
    } catch (err) {
        console.error(`Failed to render ${componentName}:`, err);
    }

})
