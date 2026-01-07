import { useProductInfo } from "../../../context/ProductInfoContext";
import { getRandomImages } from "../../../utils/helpers";
import ImageSwiper from "../../../Components/ImagesSwiper";
/**
 * ProductImages function
 */
export default function ProductImages() {
    const { product } = useProductInfo();
    console.log(product);
    const images = product?.product_images?.map(img => img.url) ?? [];
    
    return (
        <ImageSwiper images={images}></ImageSwiper>
    );
}
