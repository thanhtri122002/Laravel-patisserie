import { useState, useEffect, useRef, Suspense } from "react";
import { getTopSellingProducts } from "../../../Services/product.service";
import { motion, LayoutGroup, AnimatePresence } from "motion/react";
import { getRandomImages } from "../../../utils/helpers";
import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import LoadingSpinner from "../../../Components/LoadingSpinner";

const variants = {
    hidden: { opacity: 0, y: 50 },
    visible: { opacity: 1, y: 0, transition: { duration: 0.3 } },
    exit: { opacity: 0, y: -50, transition: { duration: 0.3 } },
};

function Thumbnail({ swiper, idx, img, setMainIndex }) {
    return (
        <motion.img
            src={img}
            onClick={() => {
                swiper?.slideToLoop(idx);
                setMainIndex(idx);
            }}
            whileHover={{ scale: 1.1 }}
            whileTap={{ scale: 0.95 }}
            className="cursor-pointer rounded-lg shadow-md transition-all"
        />
    );
}

export default function TopSelling() {
    const [products, setProducts] = useState([]);
    const [mainIndex, setMainIndex] = useState(0);
    const [isLoading, setIsLoading] = useState(true);
    const swiperRef = useRef(null);
    const limit = 8;

    useEffect(() => {
        let isMounted = true;
        (async () => {
            setIsLoading(true);
            const { data } = await getTopSellingProducts(limit);
            if (!isMounted) return;
            setProducts(data);
            setIsLoading(false);
        })();
        return () => {
            isMounted = false;
        };
    }, []);

    if (isLoading) return <LoadingSpinner />;

    return (
        <Suspense fallback={<LoadingSpinner />}>
            <div className="relative min-h-[50dvh] container mx-auto flex flex-col gap-3">
                <p className="relative font-mer text-h1 z-30 text-center mt-3">
                    Best Product
                </p>
                <div className="absolute inset-0 bg-[--Layered-Overlay] opacity-50 z-10 rounded-2xl shadow-lg"></div>
                <LayoutGroup>
                    {/* Main Image */}
                    <AnimatePresence mode="wait">
                        <motion.img
                            key={products[mainIndex]?.id || `main-${mainIndex}`}
                            src={
                                products[mainIndex]?.first_image ||
                                getRandomImages(1)
                            }
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

                    {/* Content + Thumbnails */}
                    <div className="absolute bottom-0 right-0 left-0 top-[6rem] flex flex-col z-20 md:flex-row md:top-0 ">
                        <div className="w-full md:w-1/2 flex flex-col items-center justify-center">
                            <AnimatePresence mode="wait">
                                <motion.div
                                    key={`content-${
                                        products[mainIndex]?.id || mainIndex
                                    }`}
                                    initial="hidden"
                                    animate="visible"
                                    exit="exit"
                                    variants={variants}
                                    className="text-center md:text-left"
                                >
                                    <p className="font-mer text-h1">
                                        {products[mainIndex]?.name}
                                    </p>
                                    <p className="font-mer text-body text-[--text-contrast]">
                                        {products[mainIndex]?.description}
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
                                onSwiper={(swiper) =>
                                    (swiperRef.current = swiper)
                                }
                                onSlideChange={(swiper) =>
                                    setMainIndex(swiper.realIndex)
                                }
                            >
                                {products.map((product, idx) => (
                                    <SwiperSlide
                                        key={product.id || idx}
                                        className="!w-auto"
                                    >
                                        <Thumbnail
                                            swiper={swiperRef.current}
                                            idx={idx}
                                            img={
                                                product.first_image ||
                                                getRandomImages(1)
                                            }
                                            setMainIndex={setMainIndex}
                                        />
                                    </SwiperSlide>
                                ))}
                            </Swiper>
                        </div>
                    </div>
                </LayoutGroup>

                {/* Custom pagination dots */}
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
        </Suspense>
    );
}

/**
 * Note
 * Mistakes and fix recap
 * 1/ Loop modde index
 *  Mistake: activeIndex was "shifted" when loop is true
 *  Reason: Swiper DUPLICATES slides at the start/end in loop mode. activeIndex points to the PHYSICAL slide (including the duplicates)
 *  Fix: use swiper.realIndex for the logical index of array
 *
 * 2/ Wrong useSwiper usage
 *  Mistake: Declare the useSwiper at the top of the BestProduct component
 *  Reason: useSwiper only works inside a component rendered within <Swiper></Swiper>, Outside it's undefined
 *  Fix: use useRef to store the swiper instance
 *
 * 3/ Mixing AnimatePresence and Swiper state
 *  Mistake: At one point, the main image used AnimatePresence keyed by mainIndex but Swiper also change the mainIndex -> mismatched transitions
 *  Fix: ensure mainIndex sync with Swiper's realIndex
 * 
 * 4/ use the useRef hook to store the swiper instance, the purpose is to get the Swiper instance wherever in the component and store the swiper across the re render
 *      Because after the initial render, the jsx is not mounted, IT JUST UPDATES, which mean the onSwiper will not run again, that means if not use the useRef,
 *      For example, declare a NORMAL VALUE TO STORE THE VARIBLE (let swiperInstance = null) WHICH WILL RE COMPUTE EACH RENDERING (THAT MEAN THE SWIPER INSTANCE WILL BE NUll)
 *      => React variable lost the reference to it => swiperInstance.slideToLoop(idx); wont work 
 */
