import { useState } from "react";
import { useProductInfo } from "../../context/ProductInfoContext";
import Breadcrumbs from "../../Components/Breadcrumbs";
import ProductInfo from "./Component/ProductInfomation";
import ProductImages from "./Component/ProductImages";
import CartButton from "../../Components/CartButton";
import Tabs from "../../Components/Tabs";
export default function ProductInfoPage({ children, className, ...props }) {
    const { product } = useProductInfo();
    console.log(product);
    return (
        <div className={`w-full ` + className}>
            <div className="huge-container mx-auto min-h-[20dvh]">
                <div className="flex flex-col mt-3">
                    <Breadcrumbs></Breadcrumbs>
                    <div className="flex flex-col md:flex-row  gap-5">
                        <div className="w-full md:w-1/2">
                            <ProductImages></ProductImages>
                        </div>
                        <div className="w-full md:w-1/2">
                            <ProductInfo></ProductInfo>
                        </div>
                    </div>
                </div>
            </div>
            {/* <div className="huge-container mx-auto">
                <Tabs tabs={["Home", "Profile", "Settings"]}>
                    
                    <Tabs.List>
                        <Tabs.Trigger />
                    </Tabs.List>

                    
                    <Tabs.Content>
                        <div className="text-center">
                            🏠 Welcome to the Home tab
                        </div>
                        <div className="text-center">
                            👤 This is your Profile
                        </div>
                        <div className="text-center">
                            ⚙️ Settings panel goes here
                        </div>
                    </Tabs.Content>
                </Tabs>
            </div> */}
            <CartButton />
        </div>
    );
}
