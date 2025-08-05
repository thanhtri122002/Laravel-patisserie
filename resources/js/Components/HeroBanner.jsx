export default function HeroBanner ({
        title = 'Products',
        subtitle = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus.',
        imageUrl = 'https://images.squarespace-cdn.com/content/v1/535469cde4b02e672cf340ef/1733862604022-Q3S29C5QGA43DLW45757/bakery+banner+2s.jpg?format=2500w',
        height = '50dvh'}) {
    return (
        <section className="w-full relative banner" style={{ height }} >
            <div className="absolute inset-0 bg-[--Layered-Overlay] opacity-50 z-10"></div>
            <img
                className="w-full h-full object-cover absolute z-0"
                src={imageUrl}
                alt="Banner background"
            />
            <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center z-20 ">
                <p className="text-h1 font-mer text-center">{title}</p>
                <p className="text-paragraph text-center font-mer text-[--Gray-Tertiary]">{subtitle}</p>
            </div>
        </section>
    );
}