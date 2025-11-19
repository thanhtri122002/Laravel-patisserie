import HeroBanner from "../../Components/HeroBanner";
import ProductSection from "./ProductSection";
import NewArrivalSection from "./NewArrivals";
import BestSellers from "./BestSellers";
import CartButton from "../../Components/CartButton";
import { ChefHat, CakeSlice, AlarmClockCheck } from "lucide-react";

export default function ProductPage() {
    
    return (
        <>
            {/* a stacking context relative */}
            <HeroBanner
                title="Products"
                subtitle="Delight in every bite - from delicate pastries to decadent cakes"
                imageUrl="https://images.squarespace-cdn.com/content/v1/535469cde4b02e672cf340ef/1733862604022-Q3S29C5QGA43DLW45757/bakery+banner+2s.jpg?format=2500w"
                height="50dvh"
            />

            <section className="new-arrival-section w-full relative py-[5rem]">
                <div className="full-container mx-auto ">
                    <div className="text-center">
                        <p className="font-mer text-h2 text-[--Pink-Primary]">
                            Featured product
                        </p>
                        <p className="font-mer text-h3">
                            Freshly baked and loved by our customers
                        </p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2">
                        <NewArrivalSection />
                        <BestSellers />
                    </div>
                </div>
            </section>

            <section className="why-choose-us w-full py-[5rem] bg-[--Light-Pink]">
                <div className="full-container mx-auto text-center">
                    <p className="font-mer text-h2 text-[--Pink-Primary] mb-4">
                        Why Choose Glamour Patisserie?
                    </p>
                    <p className="font-mer text-body text-[--text-default] mb-10">
                        Experience the perfect blend of flavor, quality, and
                        passion in every bite.
                    </p>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div className="flex flex-col items-center gap-3">
                            <CakeSlice
                                size={64}
                                className="text-[var(--Pink-Primary)] transition-all duration-300 hover:scale-110 hover:drop-shadow-[0_0_10px_var(--Pink-Primary)] hover:drop-shadow-[0_0_20px_var(--Pink-Primary)]"
                            />
                            <p className="font-mer text-h3 text-[--text-default]">
                                Fresh
                            </p>
                            <p className="text-center text-body text-[--text-default]">
                                Only the freshest ingredients are used in our
                                pastries.
                            </p>
                        </div>
                        <div className="flex flex-col items-center gap-3">
                            <ChefHat
                                size={64}
                                className="text-[var(--Pink-Primary)] transition-all duration-300 hover:scale-110 hover:drop-shadow-[0_0_10px_var(--Pink-Primary)] hover:drop-shadow-[0_0_20px_var(--Pink-Primary)]"
                            />
                            <p className="font-mer text-h3 text-[--text-default]">
                                Handcrafted
                            </p>
                            <p className="text-center text-body text-[--text-default]">
                                Each product is carefully handcrafted with love
                                and skill.
                            </p>
                        </div>
                        <div className="flex flex-col items-center gap-3">
                            <AlarmClockCheck
                                size={64}
                                className="text-[var(--Pink-Primary)] transition-all duration-300 hover:scale-110 hover:drop-shadow-[0_0_10px_var(--Pink-Primary)] hover:drop-shadow-[0_0_20px_var(--Pink-Primary)]"
                            />
                            <p className="font-mer text-h3 text-[--text-default]">
                                Fast Delivery
                            </p>
                            <p className="text-center text-body text-[--text-default]">
                                Get your favorite treats delivered quickly and
                                safely.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section className="from-our-kitchen-section w-full py-20 bg-[--section-light]">
                <div className="full-container flex flex-col space-y-3 mx-auto">
                    <p className="font-mer text-h1 text-center">
                        From Our Kitchen to Your Heart
                    </p>
                    <p className="font-mer text-h3 text-[--text-default] max-w-3xl mx-auto mb-8 text-center">
                        Every dessert is crafted with care, combining tradition
                        and creativity to bring you moments of pure indulgence.
                    </p>
                    <div className="grid grid-cols-1 lg:grid-cols-3 justify-center-safe gap-10 mt-10 mx-5">
                        <div className="flex flex-col items-center">
                            <div className="relative w-[20rem] h-auto aspect-[3/2] overflow-hidden rounded-2xl">
                                <img
                                    src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=240&q=80"
                                    alt="Baking process"
                                    className="absolute inset-0 h-full w-full object-cover transition-transform duration-300 hover:scale-105 rounded-2xl shadow-lg"
                                />
                            </div>

                            <p className="mt-4 font-mer text-h4 text-[--text-default]">
                                Crafted Daily
                            </p>
                            <p className="text-body text-[--text-muted]">
                                Freshly baked goods every morning to ensure
                                premium quality.
                            </p>
                        </div>
                        <div className="flex flex-col items-center">
                            <div className="relative w-[20rem] h-auto aspect-[3/2] overflow-hidden rounded-2xl">
                                <img
                                    src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&q=80"
                                    alt="Decorated cake"
                                    className="absolute inset-0 h-full w-full object-cover transition-transform duration-300 hover:scale-105 rounded-2xl shadow-lg"
                                />
                            </div>

                            <p className="mt-4 font-mer text-h4 text-[--text-default]">
                                Perfectly Decorated
                            </p>
                            <p className="text-body text-[--text-muted]">
                                Designed to please both the eyes and the taste
                                buds.
                            </p>
                        </div>
                        <div className="flex flex-col items-center">
                            <div className="relative w-[20rem] h-auto aspect-[3/2] overflow-hidden rounded-2xl">
                                <img
                                    src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&q=80"
                                    alt="Chocolate dessert"
                                    className="absolute inset-0 h-full w-full object-cover transition-transform duration-300 hover:scale-105 rounded-2xl shadow-lg"
                                />
                            </div>

                            <p className="mt-4 font-mer text-h4 text-[--text-default]">
                                Purely Delightful
                            </p>
                            <p className="text-body text-[--text-muted]">
                                Taste that speaks for itself — indulgent and
                                unforgettable.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section className="products-section w-full relative py-[5rem]">
                <div className="full-container mx-auto text-center mb-10">
                    <p className="font-mer text-h2 text-[--Pink-Primary]">
                        Our Delicious Collection
                    </p>
                    <p className="font-mer text-h3 text-[--text-default]">
                        Explore our wide selection of pastries, cakes, and
                        treats crafted to perfection
                    </p>
                    <div className="mx-auto mt-2 h-[0.125rem] w-[8rem] bg-[--Pink-Primary]"></div>
                </div>
                <div className="full-container mx-auto">
                    <ProductSection />
                </div>
            </section>

            <section className="newsletter-section w-full py-[6rem] bg-[--Light-Pink]/50">
                <div className="full-container mx-auto text-center">
                    <p className="font-mer text-h2 text-[--Pink-Primary] mb-3">
                        Join Our Sweet List
                    </p>
                    <p className="font-mer text-h3 text-[--text-default] mb-8">
                        Be the first to know about new treats and exclusive
                        offers 🍓
                    </p>

                    <form className="flex flex-col sm:flex-row justify-center items-center gap-4 max-w-xl mx-auto">
                        <input
                            type="email"
                            placeholder="Enter your email"
                            className="px-5 py-3 w-full sm:w-[20rem] rounded-full border border-[--Pink-Primary] focus:outline-none"
                        />
                        <button
                            type="submit"
                            className="bg-[--Pink-Primary] text-[--White-Primary] px-6 py-3 rounded-full transition-all hover:scale-105 hover:shadow-[0_0_15px_var(--Pink-Primary)]"
                        >
                            Subscribe
                        </button>
                    </form>
                </div>
            </section>

            <section className="w-full font-mer text-h3 text-[--text-default] py-[6rem] bg-[--Light-Pink] overflow-hidden">
                <div className="small-container mx-auto text-center relative bg-[--section-light] rounded-md p-6">
                    <div className="w-full flex flex-col md:flex-row justify-center items-center gap-5 relative">
                        <div className="flex flex-col gap-3 w-1/3">
                            <p className="font-mer text-h2 text-[--Pink-Primary]">
                                Visit Us Today
                            </p>
                            <p className="font-mer text-h3 text-[--text-default]">
                                Step into our patisserie and experience the
                                aroma of freshly baked pastries - or order
                                online for the same delightful taste at home
                            </p>
                        </div>
                        <div className="flex flex-row md:flex-col">
                            <div className="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center">
                                <div className="w-[24rem] h-auto aspect-[3/2] overflow-hidden">
                                    <img
                                        src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=400&q=80"
                                        alt="Our store"
                                        className="h-full w-full object-container rounded-xl mb-4 transition duration-700 transform hover:scale-110"
                                    />
                                </div>

                                <p className="font-mer text-h4 text-[--text-default] mb-2">
                                    Visit Our store
                                </p>
                                <p className="text-body text-[--text-muted] mb-3">
                                    123 Sweet Avenue, Parisian District
                                </p>
                                <a
                                    href="#"
                                    className="font-mer text-[--White-Primary] bg-[--Pink-Primary] px-6 py-2 rounded-full transition-all hover:scale-105 hover:shadow-[0_0_20px_var(--Pink-Primary)]"
                                >
                                    Get Directions
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <CartButton />
        </>
    );
}
