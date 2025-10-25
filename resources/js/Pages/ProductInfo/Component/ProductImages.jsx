import { useProductInfo } from "../../../context/ProductInfoContext";
import { getRandomImages } from "../../../utils/helpers";
import ImageSwiper from "../../../Components/ImagesSwiper";
/**
 * ProductImages function
 */
export default function ProductImages() {
    const { product } = useProductInfo();
    
    const images =
        product?.product_images?.length > 0
            ? product.product_images
            : getRandomImages();
    return (
        <ImageSwiper images={images}></ImageSwiper>
    );
}
