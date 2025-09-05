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
            className="w-10 h-10 border-4 border-t-transparent border-blue-500 rounded-full"
        >

        </motion.div>
    )
}