import { forwardRef } from "react";
import "../../../../scss/components/_dual-range-slider.scss";
import { formatedCurrency } from "../../../utils/helpers";

/**
 * DualPriceRange Component
 *
 * A customizable dual-thumb range slider with synchronized numeric input boxes
 * for selecting a minimum and maximum price range.
 */
const DualPriceRange = forwardRef(
    ({ className = "", priceRange, updatePriceRange }, ref) => {
        const min = 0.0;
        const max = 1000000.0;
        const [minVal, maxVal] = priceRange;

        const handleMinChange = (e) => {
            const value = Math.min(Number(e.target.value), maxVal);
            updatePriceRange(value, maxVal);
        };

        const handleMaxChange = (e) => {
            const value = Math.max(Number(e.target.value), minVal);
            updatePriceRange(minVal, value);
        };

        const calcPercent = (value) => ((value - min) / (max - min)) * 100;

        return (
            <>
                <div className={`range-slider ${className}`}>
                    <div className="h-full relative">
                        <span className="slider-track w-full bg-gray-300 block rounded-full"></span>

                        {/* Active Range Highlight */}
                        <span
                            className="slider-range absolute bg-[var(--Pink-Primary)] rounded-full h-full"
                            style={{
                                left: `${calcPercent(minVal)}%`,
                                width: `${
                                    calcPercent(maxVal) - calcPercent(minVal)
                                }%`,
                            }}
                        ></span>

                        {/* Range Inputs */}
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
                    </div>
                </div>
                <div className="flex flex-row items-center justify-between mt-5">
                    <div className="flex flex-col gap-1">
                        <p className="font-mer text-body text-[var(--text-default)]">
                            Min price
                        </p>
                        <div
                            className="flex justify-center items-center border-2 border-[var(--Soft-Rose)] 
                            rounded-lg py-1.5 px-3 bg-[var(--input-bg)] 
                            transition-all duration-300 focus-within:border-[var(--Pink-Primary)] 
                            hover:border-[var(--Pink-Primary)] w-[6.5rem]"
                        >
                            <p className="text-body">
                                {formatedCurrency(minVal)}
                            </p>
                        </div>
                    </div>
                    <div className="flex flex-col gap-1">
                        <p className="font-mer text-body text-[--text-default]">Max Price</p>
                        <div
                            className="flex justify-center items-center border-2 border-[var(--Soft-Rose)] 
                            rounded-lg py-1.5 px-3 bg-[var(--input-bg)] 
                            transition-all duration-300 focus-within:border-[var(--Pink-Primary)] 
                            hover:border-[var(--Pink-Primary)] w-[6.5rem]"
                        >
                            <p className="text-body">
                                {formatedCurrency(maxVal)}
                            </p>
                        </div>
                    </div>
                </div>
            </>
        );
    }
);

export default DualPriceRange;
