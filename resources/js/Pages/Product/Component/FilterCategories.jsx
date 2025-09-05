import React from 'react';
import Chip from '../../../Components/Chip';


const Filter = React.memo(function Filter({categoryData, selectedCategories, onSelectedCategoriesChange}) {
    return (
        <>
            <div className='flex flex-wrap gap-2'>
                {categoryData.map((category) => (
                    <Chip key={category.id} 
                        category={category} 
                        selected={selectedCategories.includes(category.id)} 
                        onSelectedCategoriesChange={onSelectedCategoriesChange} 
                    />
                ))}
            </div>
        </>
    );
});

export default Filter;

