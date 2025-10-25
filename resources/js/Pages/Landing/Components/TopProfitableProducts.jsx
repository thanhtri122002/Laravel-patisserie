import { useState, useEffect, useRef } from "react";
import { getMostProfitableProducts } from "../../../Services/product.service";
import LoadingSpinner from "../../../Components/LoadingSpinner";
import { Swiper, SwiperSlide } from "swiper/react";
import { AnimatePresence, motion } from "motion/react";
import "swiper/css";
import "swiper/css/effect-cards";
import { EffectCards } from "swiper/modules";
import { getRandomImages } from "../../../utils/helpers";

export default function TopProfitableProduct() {
    const [products, setProducts] = useState([]);
    const [mainIndex, setMainIndex] = useState(0);
    const [isLoading, setIsLoading] = useState(true);
    const swiperRef = useRef(null);
    const limit = 5;
    useEffect(() => {
        let isMounted = true;
        (async () => {
            setIsLoading(true);
            const response = await getMostProfitableProducts(limit);
            if (!isMounted) return;
            setProducts(response);
            setIsLoading(false);
        })();

        return () => {
            isMounted = false;
        };
    }, [limit]);

    return (
        <>
            {isLoading ? (
                <LoadingSpinner />
            ) : (
                <div className="flex flex-col items-center md:flex-row md:gap-20 p-16">
                    <div className="w-[30%]">
                        <Swiper
                            effect="cards"
                            grabCursor={true}
                            modules={[EffectCards]}
                            loop={false}
                            onSwiper={(swiper) => {
                                swiperRef.current = swiper;
                            }}
                            onSlideChange={(swiper) => {
                                setMainIndex(swiper.activeIndex);
                            }}
                        >
                            {products.map((product, idx) => (
                                <SwiperSlide key={idx}>
                                    <motion.img
                                        className="w-full h-full object-cover rounded-lg shadow-lg"
                                        src={
                                            product.product_images?.[0] ??
                                            getRandomImages(1)
                                        }
                                        alt={product.name}
                                    />
                                </SwiperSlide>
                            ))}
                        </Swiper>
                    </div>
                    <AnimatePresence mode="wait">
                        <motion.div
                            key={mainIndex}
                            initial={{ opacity: 0, x: 30 }}
                            animate={{ opacity: 1, x: 0 }}
                            exit={{ opacity: 0, x: -30 }}
                            transition={{ duration: 0.3, ease: "easeInOut" }}
                            className="flex flex-col"
                        >
                            <h2 className="font-mer text-h1 ">
                                {products[mainIndex].name}
                            </h2>
                            <p className="font-mer text-body text-[--text-default]">
                                {products[mainIndex].description}
                            </p>
                        </motion.div>
                    </AnimatePresence>
                </div>
            )}
        </>
    );
}
/**
 * Note
 * 1/ useRef is used to reference to the Swiper instance 
 */