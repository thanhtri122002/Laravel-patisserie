export default function Filter({categoryData, isSelected}) {
    return (
        <>
            <ul>
                {categoryData.map((category) => (
                    <li key={category.id} className="flex item-center gap-2">
                        <input type="checkbox" 
                            id={`category-${category.id}`} 
                            onChange={(e) => isSelected(category.id, e.target.checked)}/>
                    </li>
                )) }
            </ul>
        </>
    );
}