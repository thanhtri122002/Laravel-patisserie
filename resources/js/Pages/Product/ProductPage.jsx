import HeroBanner from "../../Components/HeroBanner";
import ProductSection from "./ProductSection";
import NewArrivalSection from "./NewArrivals";
import BestSellers from "./BestSellers";
import CartButton from "../../Components/CartButton";

export default function ProductPage() {
    return (
        <>
            <HeroBanner
                title="Products"
                subtitle="Delight in every bite - from delicate pastries to decadent cakes"
                imageUrl="https://images.squarespace-cdn.com/content/v1/535469cde4b02e672cf340ef/1733862604022-Q3S29C5QGA43DLW45757/bakery+banner+2s.jpg?format=2500w"
                height="50dvh"
            />

            <section className="new-arrival-section w-full relative">
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
                        <NewArrivalSection></NewArrivalSection>
                        <BestSellers></BestSellers>
                    </div>
                </div>
            </section>

            <section className="products-section w-full relative">
                <div className="full-container mx-auto">
                    <ProductSection />
                </div>
            </section>

            <CartButton />
        </>
    );
}
