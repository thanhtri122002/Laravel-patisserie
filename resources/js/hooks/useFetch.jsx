import { useState, useEffect } from "react";

/**
 * A custom hook to fetch the API which can perform some action after fetching 
 * 
 * @param {*} MainService An async function that returns the data (usually a service call).
 * @param {*} additionalAction - Optional callback to execute with the fetched data after successfully fetched
 * @param  {...any} args - Arguments that the MainService needs
 * @returns {object} An object containing:
 *  @property {any} data - The data returned by the MainService
 *  @property {boolean} loading - loading state, indicating whether the fetch is processing or not
 *  @property {Error|null} error - Any error occured
 * 
 * @example 
 *  const {data, loading , errors} = useFetch(getProduct, (res) => console.log(res.data))
 */
export default function useFetch(MainService, additionalAction = null, ...args) {
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        let isMounted = true;

        (async () => {
            try {
                setLoading(true);
                const result = await MainService(...args);
<<<<<<< HEAD
=======
                
                console.log('this iasdfiausdf :', result.data);
>>>>>>> master
                if (!isMounted) return;
                setData(result.data);
                if (typeof additionalAction === "function") {
                    additionalAction(result);
                }
            } catch (err) {
                if (isMounted) setError(err);
            } finally {
                if (isMounted) setLoading(false);
            }
        })();

        return () => {
            isMounted = false;
        };
    }, [MainService, additionalAction ,...args]); 

    return { data, setData, loading, error };
}
<<<<<<< HEAD

/**
 * The data set data in this is used to return the fetched data, let's try to figure outs what it can do more?
 */
=======
>>>>>>> master
