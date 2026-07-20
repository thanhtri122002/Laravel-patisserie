import { useState, useEffect, useRef } from "react";
import { getTopSellingProducts } from "../../../Services/product.service";
import { motion, LayoutGroup, AnimatePresence } from "motion/react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import LoadingSpinner from "../../../Components/LoadingSpinner";

const BACKEND_URL = "http://127.0.0.1:8000";

const variants = {
    hidden: { opacity: 0, y: 50 },
    visible: { opacity: 1, y: 0, transition: { duration: 0.3 } },
    exit: { opacity: 0, y: -50, transition: { duration: 0.3 } },
};

function Thumbnail({ swiperRef, idx, img, name, setMainIndex }) {
    return (
        <motion.img
            src={img}
            alt={name}
            onClick={() => {
                swiperRef.current?.slideToLoop(idx);
                setMainIndex(idx);
            }}
            whileHover={{ scale: 1.1 }}
            whileTap={{ scale: 0.95 }}
            className="cursor-pointer rounded-lg shadow-md transition-all
                       w-24 h-24 object-cover md:w-40 md:h-40"
        />
    );
}

export default function TopSelling() {
    const [products, setProducts] = useState([]);
    const [mainIndex, setMainIndex] = useState(0);
    const [isLoading, setIsLoading] = useState(true);
    const swiperRef = useRef(null);
    const limit = 8;

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

                const response = await getTopSellingProducts(limit);
                console.log("Top Selling Response:", response);

                if (!isMounted) return;

                const productsData = Array.isArray(response)
                    ? response
                    : response?.data ?? [];

                setProducts(productsData);
                setMainIndex(0);
            } catch (error) {
                console.error("Failed to fetch top selling products:", error);

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
            <div className="container mx-auto text-center py-10">
                <p className="font-mer text-body">No top selling products found.</p>
            </div>
        );
    }

    const activeProduct = products[mainIndex];

    return (
        <div className="relative min-h-[50dvh] container mx-auto flex flex-col gap-3 overflow-hidden rounded-2xl">
            <p className="relative font-mer text-h1 z-30 text-center mt-3">
                Best Product
            </p>

            <div className="absolute inset-0 bg-[--Layered-Overlay] opacity-50 z-10 rounded-2xl shadow-lg"></div>

            <LayoutGroup>
                <AnimatePresence mode="wait">
                    <motion.img
                        key={activeProduct?.id || `main-${mainIndex}`}
                        src={getProductImage(activeProduct)}
                        alt={activeProduct?.name}
                        className="w-full h-full absolute inset-0 object-cover object-center rounded-lg shadow-lg"
                        initial={{ opacity: 0, scale: 1 }}
                        animate={{
                            opacity: 1,
                            scale: 1,
                            transition: { duration: 0.3 },
                        }}
                        exit={{
                            opacity: 0,
                            scale: 0.95,
                            transition: { duration: 0.3 },
                        }}
                    />
                </AnimatePresence>

                <div className="absolute bottom-0 right-0 left-0 top-[6rem] flex flex-col z-20 md:flex-row md:top-0">
                    <div className="w-full md:w-1/2 flex flex-col items-center justify-center px-6">
                        <AnimatePresence mode="wait">
                            <motion.div
                                key={`content-${activeProduct?.id || mainIndex}`}
                                initial="hidden"
                                animate="visible"
                                exit="exit"
                                variants={variants}
                                className="text-center md:text-left"
                            >
                                <p className="font-mer text-h1">
                                    {activeProduct?.name}
                                </p>

                                <p className="font-mer text-body text-[--text-contrast]">
                                    {activeProduct?.description}
                                </p>
                            </motion.div>
                        </AnimatePresence>
                    </div>

                    <div className="w-full md:w-1/2 flex items-center justify-center">
                        <Swiper
                            modules={[Navigation]}
                            slidesPerView="auto"
                            loop={true}
                            spaceBetween={30}
                            className="mt-2 w-full"
                            onSwiper={(swiper) => {
                                swiperRef.current = swiper;
                            }}
                            onSlideChange={(swiper) => {
                                setMainIndex(swiper.realIndex);
                            }}
                        >
                            {products.map((product, idx) => (
                                <SwiperSlide
                                    key={product.id || idx}
                                    className="!w-auto"
                                >
                                    <Thumbnail
                                        swiperRef={swiperRef}
                                        idx={idx}
                                        img={getProductImage(product)}
                                        name={product.name}
                                        setMainIndex={setMainIndex}
                                    />
                                </SwiperSlide>
                            ))}
                        </Swiper>
                    </div>
                </div>
            </LayoutGroup>

            <div className="my-custom-pagination absolute bottom-10 right-1/2 transform translate-x-1/2 flex justify-center gap-3 mt-4 z-30">
                {products.map((_, idx) => (
                    <div
                        key={idx}
                        onClick={() => {
                            swiperRef.current?.slideToLoop(idx);
                            setMainIndex(idx);
                        }}
                        className={`h-3 w-3 cursor-pointer rounded-full transition-all duration-300 ${
                            idx === mainIndex
                                ? "bg-[--Pink-Primary] scale-125"
                                : "bg-[--Pink-Secondary]"
                        }`}
                    />
                ))}
            </div>
        </div>
    );
}