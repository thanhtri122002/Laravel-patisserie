import { useState } from "react";

export default function ProductFilter() {
    const [selectedCategories, setSelectedCategoires] = useState([]);
    const [products, setProducts] = useState([]);

    //fetch all the product base on the categories
    const fetchProducts = async (categories) => {
        const query = categories.map(cat => `category[]=${encodeURIComponent(cat)}`).join("&");
        const response = await fetch(``);
        const data = response.json();
        setProducts(data);
    };

    //handle the checkbox event 
    //if checked add the s
    const handleCheckboxChange = (e) => {
        const {value, checked} = e.target;
        let updatedCategories;
        if (checked) {
            updatedCategories = [...selectedCategories, value];
        }
        else {
            updatedCategories = selectedCategories.filter(category => category != value);
        }
        setSelectedCategoires(updatedCategories);
    };

    useEffect(() => {
        fetchProducts(selectedCategories);
    }, [selectedCategories]);

    return (
        <div>
            <form action="">
                
            </form>
        </div>
    )
}