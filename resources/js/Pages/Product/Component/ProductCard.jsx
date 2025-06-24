import { useCart } from '../../../context/CartContext';
import { addProductToCart } from '../../../Services/cart.service';

export default function ProductCard({ productData }) {

    const { fetchCart } = useCart();
    
    const handleProductToCart = async () => {
        await addProductToCart(productData.id, 1, productData.img);
        await fetchCart();
    }
    const formatedprice = Number(productData.price).toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });

    const truncatedDescription = productData.description.length > 100 
        ? productData.description.substring(0, 100) + '...'
        : productData.description; 

    return (
        <div className="product-card flex flex-col bg-white shadow-lg rounded-lg p-4">
            <div className="product-card__img-container">
                <img className="w-full h-full object-cover" src={productData.img} alt="" />
            </div>
            <p className="product-card__name text-center font-mer">{productData.name}</p>
            <p className="product-card__detail text-center font-mer">{truncatedDescription}</p>
            <div className="product-card__footer flex justify-between">
                <p className="product-card__price">{formatedprice}</p>
                <button onClick={handleProductToCart}>Add to cart</button>
            </div>
        </div>
    );
};
