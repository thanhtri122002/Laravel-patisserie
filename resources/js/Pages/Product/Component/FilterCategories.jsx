import React from 'react';

const Filter = React.memo(function Filter({categoryData = [], isSelected}) {
    return (
        <>
            <ul>
                {categoryData.map((category) => (
                    <li key={category.id} className="flex item-center gap-2">
                        <input type="checkbox" 
                            id={`category-${category.id}`} 
                            onChange={(e) => isSelected(category.id, e.target.checked)}/>
                            <label htmlFor={`category-${category.id}`}>{category.name}</label>
                    </li>
                    
                )) }
            </ul>
        </>
    );
});

export default Filter;

