import { motion } from "motion/react";

export default function LoadingSpinner () {
    
    return (   
        <motion.div
            animate={{  rotate: 360 }}
            transition={{
                repeat: Infinity,
                repeatType: "loop",
                duration: 1,
                ease: "linear",
            }}
            className="w-[10rem] h-[10rem] border-4 border-[--Pink-Primary] border-t-transparent rounded-full"
        >
        </motion.div>
    )
}