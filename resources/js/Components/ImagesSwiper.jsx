import { motion, LayoutGroup } from "motion/react"; // or 'framer-motion'
import { Swiper, SwiperSlide } from "swiper/react";
import { FreeMode, Navigation } from "swiper/modules";
import "swiper/css";
import { useState, useRef } from "react";

export default function ImageSwiper({ images = [] }) {
    const [selectedIndex, setSelectedIndex] = useState(0);
    const NumberOfRender = useRef(0);
    NumberOfRender.current += 1;
    console.log(NumberOfRender.current);
    return (
        <LayoutGroup>
            <div className="relative w-full aspect-[4/3] mb-4">
                {NumberOfRender.current === 1 ? (
                    <img
                        src={images[selectedIndex]}
                        className="w-full h-full object-cover rounded-2xl shadow-lg"
                        alt=""
                    />
                ) : (
                    <motion.img
                        key={selectedIndex}
                        src={images[selectedIndex]}
                        layoutId={`image-${selectedIndex}`}
                        animate={{ opacity: 1 }}
                        transition={{ layout: { duration: 0.35 } }}
                        className="w-full h-full object-cover rounded-2xl shadow-lg"
                        alt=""
                    />
                )}
            </div>

            {/* Thumbnails */}
            <Swiper
                modules={[Navigation, FreeMode]}
                slidesPerView={5}
                freeMode
                spaceBetween={6}
                className="mt-2"
            >
                {images.map((src, i) => (
                    <SwiperSlide key={i}>
                        <motion.img
                            layoutId={`image-${i}`}
                            src={src}
                            onClick={() => setSelectedIndex(i)}
                            className={`w-full h-20 object-cover rounded-lg cursor-pointer
                ${
                    i === selectedIndex
                        ? "border-pink-500 scale-105"
                        : "border-transparent"
                }
                border`}
                            style={{ transition: "transform .2s" }}
                            alt=""
                        />
                    </SwiperSlide>
                ))}
            </Swiper>
        </LayoutGroup>
    );
}
