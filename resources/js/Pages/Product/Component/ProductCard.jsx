export default function ProductCard({ productData }) {
    
    return (
        <div className="product-card flex flex-col bg-white shadow-lg rounded-lg p-4">
            <p className="text-body font-mer mb-2 bold">{productData.name}</p>
            <p className="text-body font-mer mb-2">Price: {productData.price}</p>
        </div>
    );
};
