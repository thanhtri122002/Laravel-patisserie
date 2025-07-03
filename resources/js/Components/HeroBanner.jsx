export default function HeroBanner ({
        title = 'Products',
        subtitle = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus.',
        imageUrl = 'https://images.squarespace-cdn.com/content/v1/535469cde4b02e672cf340ef/1733862604022-Q3S29C5QGA43DLW45757/bakery+banner+2s.jpg?format=2500w',
        height = '50dvh'}) {
    return (
        <section className={`w-full h-[${height}] relative banner`}>
            <div className="absolute left-0 right-0 h-[90%] bg-[--Layered-Overlay] opacity-50 z-10"></div>
            <img
            className="w-full h-[90%] object-cover absolute top-0 left-0 z-0"
            src={imageUrl}
            alt="Banner background"
            />
            <div className="category-title flex flex-col justify-center items-center relative z-20 h-full">
            <p className="text-h1 font-mer text-center">{title}</p>
            <p className="text-paragraph text-center font-mer text-[--Gray-Tertiary]">{subtitle}</p>
            </div>
        </section>
    );
}