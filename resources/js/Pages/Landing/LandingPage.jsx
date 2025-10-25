import HeroBanner from "../../Components/HeroBanner";
import Tabs from "../../Components/Tabs";
import TopSelling from "./Components/TopSellingProducts";
import TopProfitableProduct from "./Components/TopProfitableProducts";
import OurImpact from "./Components/OurImpact";
import CardContent from "../../Components/CardContent";
import UsersNotifications from "../../Components/UsersNotification";
export default function LandingPage() {
    return (
        <>  
            <UsersNotifications />
            <HeroBanner
                title="Glamour Patisserie"
                subtitle="Freshly Patisserie
            for sweet-tooth"
            />
            <section className="w-full flex flex-col justify-center items-center my-[3rem]">
                <p className="font-mer text-h1">About Us</p>
                <Tabs tabs={["Our mission", "Our values", "Our goals"]}>
                    <Tabs.List className="py-8">
                        <Tabs.Trigger />
                    </Tabs.List>
                    <Tabs.Content>
                        <div className="flex flex-col md:flex-row items-center gap-6 md:gap-12">
                            <div className="h-[360px] w-full aspect-[2/3] rounded-lg overflow-hidden shadow-md">
                                <img
                                    className="w-full h-full object-cover transform hover:scale-105 transition duration-500 ease-in-out"
                                    src="/storage/images/elements/about-us.jpg"
                                    alt=""
                                />
                            </div>
                            <div className="flex flex-col gap-y-4 text-center md:text-left">
                                <p className="font-mer text-h2 text-[--Soft-Rose]">
                                    Providing quality products for all be happy
                                    and peace
                                </p>
                                <p className="font-mer text-body text-[--text-default]">
                                    We strive to deliver exceptional products
                                    that meet your needs, ensuring happiness and
                                    peace in every aspect of your life.
                                </p>
                            </div>
                        </div>

                        <div className="flex flex-col md:flex-row items-center gap-6 md:gap-12">
                            <div className="h-[360px] w-full aspect-[2/3] rounded-lg overflow-hidden shadow-md">
                                <img
                                    className="w-full h-full object-cover transform hover:scale-105 transition duration-500 ease-in-out"
                                    src="/storage/images/elements/about-us-2.jpg"
                                    alt=""
                                />
                            </div>
                            <div className="flex flex-col gap-y-4 text-center md:text-left">
                                <p className="font-mer text-h2 text-[--Soft-Rose]">
                                    Guided by integrity and excellence
                                </p>
                                <p className="font-mer text-body text-[--text-default]">
                                    Our values are rooted in trust, honesty, and
                                    excellence, shaping the foundation of our
                                    interactions with customers and communities.
                                </p>
                            </div>
                        </div>

                        <div className="flex flex-col md:flex-row items-center gap-6 md:gap-12">
                            <div className="h-[360px] w-full aspect-[2/3] rounded-lg overflow-hidden shadow-md">
                                <img
                                    className="w-full h-full object-cover transform hover:scale-105 transition duration-500 ease-in-out"
                                    src="/storage/images/elements/about-us-3.jpg"
                                    alt=""
                                />
                            </div>
                            <div className="flex flex-col gap-y-4 text-center md:text-left">
                                <p className="font-mer text-h2 text-[--Soft-Rose]">
                                    Empowering growth and innovation
                                </p>
                                <p className="font-mer text-body text-[--text-default]">
                                    Our goal is to continuously innovate and
                                    expand, ensuring we bring the best solutions
                                    to our customers and foster a culture of
                                    growth.
                                </p>
                            </div>
                        </div>
                    </Tabs.Content>
                </Tabs>
            </section>

            <section className="w-full px-[2dvw] py-16">
                <div className="container mx-auto flex flex-col items-center gap-6">
                    <p className="text-center opacity-80 font-mer text-body text-[--text-default]">
                        Bringing joy to customers with artisanal pastries,
                        cakes, and sweet delights crafted with passion.
                    </p>
                    <p className="font-mer text-h2 text-center text-[--text-default] max-w-[30.5rem]">
                        Delicious Creations for Every Occasion
                    </p>
                    <div className="w-full grid gap-6 md:grid-cols-2">
                        <CardContent
                            img="/storage/images/icons/cake-1.svg"
                            title="Freshly Baked Every Day"
                            body="Enjoy handmade pastries, cakes, and breads baked daily with the finest ingredients."
                        />
                        <CardContent
                            img="/storage/images/icons/cake-1.svg"
                            title="Custom Cakes & Orders"
                            body="Celebrate special moments with personalized cakes, tailored designs, and flavors you love."
                        />
                        <CardContent
                            img="/storage/images/icons/cake-1.svg"
                            title="Seamless Online Ordering"
                            body="Easily browse, customize, and order your favorite treats online with convenient pickup or delivery."
                        />
                        <CardContent
                            img="/storage/images/icons/cake-1.svg"
                            title="Connecting with Our Community"
                            body="Sharing the love for pastries by supporting local events and bringing sweetness to every gathering."
                        />
                    </div>
                </div>
            </section>

            <section className="best-product-section w-full">
                <div className="best-product-container flex flex-col items-center justify-center">
                    <TopSelling />
                </div>
            </section>

            <section className="testimonials w-full my-[5rem] bg-[--section-accent] py-16">
                <div className="xs-container mx-auto text-center">
                    <p className="font-mer text-h1 mb-12 text-[--text-default]">
                        What Our Customers Say
                    </p>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div className="bg-[--Gray-Tertiary] rounded-lg shadow-md p-6 transition duration-500 transform hover:-translate-y-6">
                            <p className="text-body text-[--text-default] ">
                                "The best patisserie I’ve ever tried! Fresh and
                                delightful every time."
                            </p>
                            <p className="mt-4 font-mer text-[--Soft-Rose] ">
                                — Anna Nguyen
                            </p>
                        </div>
                        <div className="bg-[--Gray-Tertiary] rounded-lg shadow-md p-6 transition duration-500 transform hover:-translate-y-6">
                            <p className="text-body text-[--text-default]">
                                "Their chocolate croissant is pure heaven.
                                Highly recommend!"
                            </p>
                            <p className="mt-4 font-mer text-[--Soft-Rose]">
                                — David Tran
                            </p>
                        </div>
                        <div className="bg-[--Gray-Tertiary] rounded-lg shadow-md p-6 transition duration-500 transform hover:-translate-y-6">
                            <p className="text-body text-[--text-default]">
                                "Perfect for gifts and celebrations. Always
                                beautifully packed."
                            </p>
                            <p className="mt-4 font-mer text-[--Soft-Rose]">
                                — Sophia Le
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section className="w-full section-ingredients my-[5rem]">
                <div className="xxs-container mx-auto">
                    <div className="flex flex-col items-center gap-6">
                        <p className="max-w-[45rem] font-mer text-center">
                            At our patisserie, every creation begins with the
                            finest ingredients. From velvety French butter to
                            rich, artisanal chocolate, each element is carefully
                            selected to ensure exceptional flavor and texture.
                        </p>
                        <p className="text-center text-h1 text-[--Pink-Primary]">
                            Pure. Authentic. Irresistible.
                        </p>
                        <div className="section-standard grid items-center justify-items-center gap-12 md:grid-cols-2 md:gap-6">
                            <div className="flex flex-col gap-6">
                                <div className="standard">
                                    <div className="img-icon">
                                        <img
                                            className="size-10"
                                            src="/storage/images/icons/ingredients-1.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div className="standard-content">
                                        <p className="font-mer text-h3">
                                            Freshness & Quality
                                        </p>
                                        <p className="font-mer text-body">
                                            Fresh dairy, premium flour, and
                                            seasonal fruits ensure rich flavors
                                            and perfect textures.
                                        </p>
                                    </div>
                                </div>
                                <div className="standard ">
                                    <div className="img-icon">
                                        <img
                                            className="size-10"
                                            src="/storage/images/icons/ingredients-2.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div className="standard-content">
                                        <p className="font-mer text-h3">
                                            Authenticity & Origin
                                        </p>
                                        <p className="font-mer text-body">
                                            Ingredients like French butter,
                                            Belgian chocolate, and Madagascar
                                            vanilla bring true artisanal taste.
                                        </p>
                                    </div>
                                </div>
                                <div className="standard">
                                    <div className="img-icon ">
                                        <img
                                            className="size-10"
                                            src="/storage/images/icons/ingredients-3.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div className="standard-content">
                                        <p className="font-mer text-h3">
                                            Purity & Natural Ingredients
                                        </p>
                                        <p className="font-mer text-body">
                                            No artificial additives—only pure,
                                            natural ingredients for the finest
                                            pastries.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div className="ingredient-img relative inset-0">
                                <img
                                    src="/storage/images/elements/ingredients-big.jpg"
                                    alt=""
                                />
                                <img
                                    className="absolute right-5 bottom-2 w-[5rem] "
                                    src="/storage/images/elements/ingredient-bounce-2.jpg"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="w-full mb-[3rem]">
                <div className="container mx-auto p-5 bg-[--Pink-Secondary] rounded-[1.5rem] shadow-lg">
                    <TopProfitableProduct />
                </div>
            </section>

            <section className="w-full bg-[--section-muted] p-3">
                <div className="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-y-5 justify-items-center">
                    <OurImpact />
                </div>
            </section>

            <section className="moving-text-banner w-full my-[5rem]">
                <div className="overflow-hidden">
                    <div className="upper-text flex gap-5 justify-center moving-right">
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Freshly Baked
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Decadent Flavors
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Premium Ingredients
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Freshly Baked
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Decadent Flavors
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Premium Ingredients
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Freshly Baked
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Decadent Flavors
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Premium Ingredients
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Freshly Baked
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Decadent Flavors
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Premium Ingredients
                        </p>
                    </div>
                    <div className="lower-text flex gap-5 justify-center moving-left mt-[2.625rem]">
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Indulge in our heavenly desserts
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Crafted with care and passion
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Perfect for any occasion
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Indulge in our heavenly desserts
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Crafted with care and passion
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Perfect for any occasion
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Indulge in our heavenly desserts
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Crafted with care and passion
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Perfect for any occasion
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Indulge in our heavenly desserts
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Crafted with care and passion
                        </p>
                        <p className="font-mer text-h1 text-[--Pink-Primary] whitespace-nowrap">
                            Perfect for any occasion
                        </p>
                    </div>
                </div>
            </section>
            <section className="w-full section-freqAsked my-[5rem]">
                <div className="xxs-container mx-auto">
                    <div className="flex flex-col md:flex-row items-center gap-[2.62rem]">
                        <div className="md:max-w-[45%] flex flex-col gap-6">
                            <p className="font-mer text-h1">
                                Have a sweet question?
                            </p>
                            <p className="font-mer text-h2 text-[--Soft-Rose]">
                                FREQUENTLY ASKED QUESTIONS
                            </p>
                            <p className="font-mer text-body text-[--text-default]">
                                Our team is here to assist you with any
                                inquiries. Explore these answers to commonly
                                asked questions about our patisserie, or feel
                                free to reach out to us directly.
                            </p>
                        </div>
                        <div className="flex flex-col gap-4 flex-1 w-full ">
                            <button className="p-5 flex justify-between items-center group gap-6">
                                <div className="flex flex-col text-left">
                                    <p className="font-mer text-body text-[--text-default]">
                                        Do you offer custom cakes for special
                                        occasions?
                                    </p>
                                    <div className="h-0 overflow-hidden group-focus:h-[8rem] transition-all">
                                        <p className="pt-2 font-mer text-body text-[--text-default]">
                                            Yes! We specialize in custom cakes
                                            for birthdays, weddings, and other
                                            special events. You can choose from
                                            a variety of flavors, designs, and
                                            decorations. We recommend placing
                                            your order at least 48 hours in
                                            advance.
                                        </p>
                                    </div>
                                </div>
                                <img
                                    className="size-5"
                                    src="/storage/images/icons/donut.svg"
                                    alt=""
                                />
                            </button>
                            <button className="p-5 flex justify-between items-center group gap-6">
                                <div className="flex flex-col text-left">
                                    <p className="font-mer text-body text-[--text-default]">
                                        Are your pastries made fresh daily?
                                    </p>
                                    <div className="h-0 overflow-hidden group-focus:h-[7rem] transition-all">
                                        <p className="pt-2 font-mer text-body text-[--text-default]">
                                            Absolutely! All of our pastries,
                                            cakes, and breads are made fresh
                                            every morning using the finest
                                            ingredients to ensure the best
                                            quality and taste.
                                        </p>
                                    </div>
                                </div>
                                <img
                                    className="size-5"
                                    src="/storage/images/icons/donut.svg"
                                    alt=""
                                />
                            </button>
                            <button className="p-5 flex justify-between items-center group gap-6">
                                <div className="flex flex-col text-left">
                                    <p className="font-mer text-body text-[--text-default]">
                                        Do you have gluten-free or vegan
                                        options?
                                    </p>
                                    <div className="h-0 overflow-hidden group-focus:h-[7rem] transition-all">
                                        <p className="pt-2 font-mer text-body text-[--text-default]">
                                            Yes, we offer a selection of
                                            gluten-free and vegan pastries.
                                            However, since our kitchen handles
                                            wheat and dairy, we recommend
                                            informing us of any allergies when
                                            placing an order.
                                        </p>
                                    </div>
                                </div>
                                <img
                                    className="size-5"
                                    src="/storage/images/icons/donut.svg"
                                    alt=""
                                />
                            </button>
                            <button className="p-5 flex justify-between items-center group gap-6">
                                <div className="flex flex-col text-left">
                                    <p className="font-mer text-body text-[--text-default]">
                                        Can I place an order online for pickup
                                        or delivery?
                                    </p>
                                    <div className="h-0 overflow-hidden group-focus:h-[7rem] transition-all">
                                        <p className="pt-2 font-mer text-body text-[--text-default]">
                                            Yes, you can order online through
                                            our website or call us directly for
                                            pickup and delivery options.
                                            Delivery availability may vary based
                                            on your location.
                                        </p>
                                    </div>
                                </div>
                                <img
                                    className="size-5"
                                    src="/storage/images/icons/donut.svg"
                                    alt=""
                                />
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </>
    );
}
