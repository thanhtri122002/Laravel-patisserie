import HeroBanner from '../../Components/HeroBanner';
import ProductSection from './ProductSection';
import CartButton from '../../Components/CartButton';

export default function ProductPage() {
  return (
    <>
      <HeroBanner
        title="Products"
        subtitle="Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus."
        imageUrl="https://images.squarespace-cdn.com/content/v1/535469cde4b02e672cf340ef/1733862604022-Q3S29C5QGA43DLW45757/bakery+banner+2s.jpg?format=2500w"
        height="50dvh"
      />

      <section className="products-section w-full relative">
        <div className="container mx-auto">
          <ProductSection />
        </div>
      </section>

      <CartButton />
    </>
  );
}
