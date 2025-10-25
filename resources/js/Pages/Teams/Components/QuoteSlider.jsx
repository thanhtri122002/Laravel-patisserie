import { useState, useEffect } from "react";
import { motion, AnimatePresence } from "motion/react";

const quotes = [
  { text: "Pastry is the poetry of flour, butter, and love.", author: "Chef Amélie" },
  { text: "Precision in baking is what sets magic in motion.", author: "Chef Minh" },
  { text: "We don’t bake to impress—we bake to connect.", author: "Chef Lena" },
];

export default function QuoteSlider() {
    const [active, setActive] = useState(0);

    useEffect(() => {
        const timer = setInterval(() => {
            setActive((prevIndex) => (prevIndex + 1) % quotes.length);
        }, 5000)

        return () => clearInterval(timer);
    },[])

    return (
        <>
            <div className="w-full mx-auto text-center py-12 px-6 relative min-h-[100px] mt-10">
                <AnimatePresence mode='wait'>
                    <motion.div
                        key={active}
                        initial={{ opacity: 0, x: 100 }}
                        animate={{ opacity: 1, x: 0 }}
                        exit={{ opacity: 0, x: -100 }}
                        transition={{ duration: 0.3, ease: "easeInOut" }}
                        className="flex flex-col gap-2 items-center"
                    >   
                        <blockquote className="font-mer text-h3 text-[--Soft-Rose]">
                            {quotes[active].text}
                        </blockquote>
                        <p className="font-mer text-h3 text-[--Soft-Rose]">
                            —{quotes[active].author}
                        </p>
                    </motion.div>
                </AnimatePresence>
                <div className="flex justify-center gap-2 mt-6">
                    {quotes.map((_, i) => (
                    <div
                        key={i}
                        className={`h-2 w-2 rounded-full transition-all duration-300 ${
                        i === active ? "bg-[--Pink-Primary] scale-125" : "bg-[--Pink-Secondary]"
                        }`}
                    />
                    ))}
                </div>
            </div>

        </>
    )
}
