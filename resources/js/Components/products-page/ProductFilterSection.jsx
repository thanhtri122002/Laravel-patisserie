import { useState } from "react";

export default function ProductFilter() {
    const [selectedCategories, setSelectedCategoires] = useState([]);
    const [products, setProducts] = useState([]);

    const fetchProducts = async (categories) => {
        const query = categories.map(cat => `category[]=${encodeURIComponent(cat)}`).join("&");
        const response = await fetch(``);
        const data = response.json();
        setProducts(data);
    };

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