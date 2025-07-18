import { memo } from "react";
import { useState } from "react";

/**
 * toggleSelected function:
 * - Toggles the local chip state (`selectedCategory`) between true and false.
 * - Calls the parent callback `isSelected` to inform parent of the new selected state and id.
 * - Uses the functional updater of setState to ensure correct value.
 */

const Chip = memo(function Chip( { category, selected, onSelectedCategoriesChange }) {
    
    const toggleSelected = () => {
        onSelectedCategoriesChange(category.id, !selected);
    }

    return (
        <button className={`chip ${selected ? "chip--selected" : "chip--unselected"}`} onClick={toggleSelected}>
            {category.name}
        </button>
    )
} )


export default Chip;