import { useRef, forwardRef, useImperativeHandle } from "react";
import "../../../../scss/components/_dual-range-slider.scss";

/**
 * DualPriceRange Component
 *
 * A customizable dual-thumb range slider for selecting a minimum and maximum price range.
 * Styled using SCSS and Tailwind utility classes.
 *
 * Features:
 * - Two independent slider thumbs (min & max).
 * - Prevents overlap with a configurable minimum gap (here: 400,000 VND).
 * - Dynamic track highlight between the two values.
 * - Tooltips that display the current min and max values in localized Vietnamese currency format.
 *
 * Props:
 * @param {string} className - Optional. Additional CSS classes to extend or override styling.
 *
 * Internal State:
 * @state {number} minVal - The currently selected minimum price.
 * @state {number} maxVal - The currently selected maximum price.
 *
 * Constants:
 * @constant {number} min - The lowest possible value (0.0).
 * @constant {number} max - The highest possible value (1,000,000.0).
 * @constant {number} gap - The enforced minimum distance (400,000.0) between minVal and maxVal.
 *
 * Functions:
 * @function handleMinChange - Updates minVal while ensuring it does not exceed (maxVal - gap).
 * @function handleMaxChange - Updates maxVal while ensuring it is not less than (minVal + gap).
 * @function calcPercent - Converts a given value into a percentage position relative to min and max, for styling.
 * @function formatedprice - Formats numeric values into Vietnamese Dong currency (₫) using Intl.NumberFormat.
 *
 * UI Structure:
 * - A full track line (.slider-track).
 * - A highlighted range segment (.slider-range) between minVal and maxVal.
 * - Two <input type="range"> elements controlling min and max.
 * - Tooltip elements above each thumb showing the current values.
 *
 * Example Usage:
 * ```jsx
 * <DualPriceRange className="mt-4" />
 * ```
 */
const DualPriceRange = forwardRef(
    ({ className = " ", priceRange, updatePriceRange }, ref) => {
        const min = 0.0;
        const max = 1000000.0;
        const [minVal, maxVal] = priceRange;
        const toolTipHeightRef = useRef(null);

        
        const handleMinChange = (e) => {
            const value = Math.min(Number(e.target.value), maxVal - 4000);
            updatePriceRange(value, maxVal);
        };

        const handleMaxChange = (e) => {
            const value = Math.max(Number(e.target.value), minVal + 4000);
            updatePriceRange(minVal, value);
        };

        const calcPercent = (value) => {
            return ((value - min) / (max - min)) * 100;
        };

        const formatedprice = (price) => {
            return Number(price).toLocaleString("vi-VN", {
                style: "currency",
                currency: "VND",
            });
        };
        return (
            <>
                <div className={`range-slider ` + className}>
                    <span className="slider-track w-full bg-gray-300 block rounded-full"></span>
                    <span
                        className="slider-range absolute bg-[var(--Pink-Primary)] rounded-full h-full"
                        style={{
                            left: `${calcPercent(minVal)}% `,
                            width: `${
                                calcPercent(maxVal) - calcPercent(minVal)
                            }%`,
                        }}
                    ></span>
                    <input
                        type="range"
                        min={min}
                        max={max}
                        value={minVal}
                        step="1000"
                        onChange={handleMinChange}
                    />
                    <input
                        type="range"
                        min={min}
                        max={max}
                        value={maxVal}
                        step="1000"
                        onChange={handleMaxChange}
                    />
                    <span
                        className="tool-tip tool-tip-min text-body absolute -translate-x-1/2"
                        style={{
                            left: `calc(${calcPercent(minVal)}% + 0.5rem)`,
                        }}
                    >
                        {formatedprice(minVal)}
                    </span>
                    <span
                        className="tool-tip tool-tip-max text-body absolute -translate-x-1/2"
                        style={{
                            left: `calc(${calcPercent(maxVal)}% - 0.5rem)`,
                        }}
                    >
                        {formatedprice(maxVal)}
                    </span>
                </div>
            </>
        );
    }
);

export default DualPriceRange;
