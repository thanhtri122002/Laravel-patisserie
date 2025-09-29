import { memo, forwardRef } from "react";
import { motion } from "motion/react";
/**
 * toggleSelected function:
 * - Toggles the local chip state (`selectedCategory`) between true and false.
 * - Calls the parent callback `isSelected` to inform parent of the new selected state and id.
 * - Uses the functional updater of setState to ensure correct value.
 */

const ChipBase = forwardRef(function Chip(
    { category, selected, onSelectedCategoriesChange, ...props },
    ref
) {
    const toggleSelected = () => {
        onSelectedCategoriesChange(category.id, !selected);
    };

    return (
        <button
            ref={ref}
            className={`chip ${
                selected ? "chip--selected" : "chip--unselected"
            }`}
            onClick={toggleSelected}
            {...props}
        >
            {category.name}
        </button>
    );
});

const ChipMotion = motion(memo(ChipBase));
export default ChipMotion;
