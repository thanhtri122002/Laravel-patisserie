import { useState, useEffect, Suspense } from "react";
import { motion } from "motion/react";
import { getProducts } from "../../../Services/product.service";
<<<<<<< HEAD
import { getCountUser } from "../../../Services/user.service";
import useCountUp from "../../../hooks/useCountUp";
import { getCountInvoiceWithStatus } from "../../../Services/invoice.service";
=======
import { getUsers } from "../../../Services/user.service";
import { getInvoiceWithStatus } from "../../../Services/invoice.service";
import useCountUp from "../../../hooks/useCountUp";
>>>>>>> master

function Loading() {
    return (
        <div className="w-full flex items-center justify-center p-6">
            <div className="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
            <span className="ml-3 text-gray-600">Loading...</span>
        </div>
    );
}
<<<<<<< HEAD
/**
 * OurImpact Component
 *
 * Renders an impact section that displays animated counters
 * for the total number of products, customers, and completed invoices.
 *
 * This is a client component that:
 * - Fetches counts from the backend when mounted
 * - Stores the results in local state using useState
 * - Animates the values using a custom useCountUp hook
 *
 * @component
 * @returns {JSX.Element} A section with three counters for products, customers, and orders
 */
=======

>>>>>>> master
export default function OurImpact() {
    const [totals, setTotals] = useState({
        products: 0,
        customers: 0,
        invoices: 0,
    });

    useEffect(() => {
        (async () => {
            const responseProduct = await getProducts();
<<<<<<< HEAD
            const userTotal = await getCountUser();
            const invoiceTotal = await getCountInvoiceWithStatus(2);
            setTotals({
                products: responseProduct.data.total,
                customers: userTotal.data,
                invoices: invoiceTotal.data,
            });
        })();
    }, []);
    
=======
            const responseUser = await getUsers();
            const responseInvoice = await getInvoiceWithStatus(2);

            setTotals({
                products: responseProduct.data.total,
                customers: responseUser.total,
                invoices: responseInvoice.total,
            });
        })();
    }, []);

>>>>>>> master
    const products = useCountUp(totals.products);
    const customers = useCountUp(totals.customers);
    const invoices = useCountUp(totals.invoices);
    return (
        <Suspense fallback={<Loading />}>
            <div className="flex flex-col items-center justify-center">
                <p className="text-h1">Products</p>
                <motion.p className="text-h1">{products}</motion.p>
            </div>
            <div className="flex flex-col items-center justify-center">
                <p className="text-h1 font-mer">Customers</p>
                <motion.p className="text-h1">{customers}</motion.p>
            </div>
            <div className="flex flex-col items-center justify-center">
                <p className="font-mer text-h1">Orders</p>
                <motion.p className="text-h1">{invoices}</motion.p>
            </div>
        </Suspense>
    );
}
