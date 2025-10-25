import { useProductInfo } from "../../context/ProductInfoContext";
import Breadcrumbs from "../../Components/Breadcrumbs";
import ProductInfo from "./Component/ProductInfomation";
import ProductImages from "./Component/ProductImages";
import CartButton from "../../Components/CartButton";

export default function ProductInfoPage({ children, className, ...props }) {
    const { product } = useProductInfo();
    console.log(product);
    return (
        <div className={`w-full ` + className}>
            <div className="huge-container mx-auto min-h-[20dvh]">
                <div className="flex flex-col mt-3">
                    <Breadcrumbs />
                    <div className="flex flex-col md:flex-row gap-5 my-5">
                        <div className="w-full md:w-1/2">
                            <ProductImages />
                        </div>
                        <div className="w-full md:w-1/2">
                            <ProductInfo />
                        </div>
                    </div>
                </div>
            </div>
            <CartButton />
        </div>
    );
}
