import { useAnimate, useMotionValue, useTransform } from "motion/react";
import { useEffect } from "react";

/**
 * A custom hook for animating a number value smoothly from 0 to `target`.
 *
 * @param {number} target - The target number to count up to.
 * @param {number} duration - The animation duration in seconds. Default = 2s.
 * @returns {MotionValue<number>} - A reactive rounded motion value you can bind directly in motion components.
 *
 */

export default function useCountUp(target, duration = 5) {
    const x = useMotionValue(0);
    const rounded = useTransform(x, (latest) => Math.round(latest));
    const [scope, animate] = useAnimate(); 
    useEffect(() => {
        const control = animate(x, target, { duration });

        return () => {
            control.stop();
        }
    }, [target, duration]);
    
    return rounded;
}


/**
 * Note
 * 1/ useMotionvalue creates a special reactive variable that stores an animatable value. 
 *    Unlike useState, updating a motion value doesn’t trigger React re-renders — it’s designed for performance.
 * 2/ useTransform is used to derive a new motion value from an existing one.
 * 3/ animate runs the actual tween animation between the current value and target.
 */
