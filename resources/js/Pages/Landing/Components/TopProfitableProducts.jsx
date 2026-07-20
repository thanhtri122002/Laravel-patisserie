import { useState, useEffect, useRef } from "react";
import { getMostProfitableProducts } from "../../../Services/product.service";
import LoadingSpinner from "../../../Components/LoadingSpinner";
import { Swiper, SwiperSlide } from "swiper/react";
import { AnimatePresence, motion } from "motion/react";
import "swiper/css";
import "swiper/css/effect-cards";
import { EffectCards } from "swiper/modules";

const BACKEND_URL = "http://127.0.0.1:8000";

export default function TopProfitableProduct() {
    const [products, setProducts] = useState([]);
    const [mainIndex, setMainIndex] = useState(0);
    const [isLoading, setIsLoading] = useState(true);
    const swiperRef = useRef(null);
    const limit = 5;

    const getProductImage = (product) => {
        const image = product?.product_images?.[0]?.url;

        if (!image) {
            return "https://via.placeholder.com/800x400";
        }

        if (image.startsWith("http")) {
            return image;
        }

        if (image.startsWith("/storage")) {
            return `${BACKEND_URL}${image}`;
        }

        return `${BACKEND_URL}/storage/${image}`;
    };

    useEffect(() => {
        let isMounted = true;

        (async () => {
            try {
                setIsLoading(true);

                const response = await getMostProfitableProducts(limit);
                console.log("Most Profitable Products:", response);

                if (!isMounted) return;

                const productsData = Array.isArray(response)
                    ? response
                    : response?.data ?? [];

                setProducts(productsData);
                setMainIndex(0);
            } catch (error) {
                console.error("Failed to fetch most profitable products:", error);

                if (isMounted) {
                    setProducts([]);
                }
            } finally {
                if (isMounted) {
                    setIsLoading(false);
                }
            }
        })();

        return () => {
            isMounted = false;
        };
    }, []);

    if (isLoading) {
        return <LoadingSpinner />;
    }

    if (!products.length) {
        return (
            <div className="text-center py-10">
                <p className="font-mer text-body">
                    No profitable products found.
                </p>
            </div>
        );
    }

    const activeProduct = products[mainIndex];

    return (
        <div className="flex flex-col items-center md:flex-row md:gap-20 p-16">
            <div className="w-full md:w-[30%]">
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
                    {products.map((product) => (
                        <SwiperSlide key={product.id}>
                            <motion.img
                                className="w-full h-[420px] object-cover rounded-lg shadow-lg"
                                src={getProductImage(product)}
                                alt={product.name}
                            />
                        </SwiperSlide>
                    ))}
                </Swiper>
            </div>

            <AnimatePresence mode="wait">
                <motion.div
                    key={activeProduct?.id || mainIndex}
                    initial={{ opacity: 0, x: 30 }}
                    animate={{ opacity: 1, x: 0 }}
                    exit={{ opacity: 0, x: -30 }}
                    transition={{ duration: 0.3, ease: "easeInOut" }}
                    className="flex flex-col mt-8 md:mt-0 md:w-1/2"
                >
                    <h2 className="font-mer text-h1">
                        {activeProduct?.name}
                    </h2>

                    <p className="font-mer text-body text-[--text-default]">
                        {activeProduct?.description}
                    </p>
                </motion.div>
            </AnimatePresence>
        </div>
    );
}