/**
 * Creates a debounced version of a function.
 *
 * The returned function delays executing `fn` until after the specified
 * delay has passed since the last call. It also returns a Promise,
 * allowing you to await the debounced function and capture its result.
 *
 * @param {Function} fn - The function to debounce. Can be async or sync.
 * @param {number} delay - Delay in milliseconds before invoking `fn`.
 * @returns {Function} A debounced function that returns a Promise.
 *
 * @example
 * const search = debounce(fetchResults, 300);
 * 
 * search("cake").then(console.log);
 * // Only the final call within 300ms will run.
 */
const debounce = (fn, delay) => {
    let timer;
    return (...args) => {
        clearTimeout(timer);
<<<<<<< HEAD
        
=======
        console.log(timer);
>>>>>>> master
        return new Promise((resolve, reject) => {
            timer = setTimeout(async () => {
                try {
                    const result = await fn(...args);
                    resolve(result);
                } catch (err) {
                    reject(err);
                }
            }, delay);
        });
    };
};

const makeQueryString = (params) => {
    Object.keys(params).forEach((key) => {
        if (
            params[key] === undefined ||
            params[key] === null ||
            params[key] === ""
        ) {
            delete params[key];
        }
    });

    const queryString = Object.entries(params)
        .map(([key, value]) =>
            Array.isArray(value)
                ? value
                      .map((val) => `${key}[]=${encodeURIComponent(val)}`)
                      .join("&")
                : `${key}=${encodeURIComponent(value)}`
        )
        .join("&");

    return queryString;
};

const formatedCurrency = (number) => {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(number);
};

const handleApiError = (err) => {
    if (err.response) {
        if (err.response.status === 401) {
            if (window.location.pathname !== '/authToggle') {
                window.location.href = '/authToggle';
            }
            
            return { data: null, errors: err.response.data };
        }
        else {
            return {
                data: null,
                errors: err.response.data?.errors || err.response.data,
            };
        }
        
    }
    return { data: null, errors: "Something went wrong"};
};

const truncatedParagraph = (paragraph, limit) => {
    return paragraph.length > limit
        ? paragraph.slice(0, limit) + "..."
        : paragraph;
};

const getRandomImages = (quantity = 10, width = 240, height = 240) => {
    const randImages = [];
    for (let i = 0; i < quantity; i++) {
        const currentImgLink = `https://picsum.photos/${width}/${height}?random=${i}`;
        randImages.push(currentImgLink);
    }
    return randImages;
};

const getCircularArray = (idx, arr = []) => {
    if (!arr.length) return [];
    return [
        ...arr.slice(idx), 
        ...arr.slice(0, idx) 
    ];
};


export {
    debounce,
    makeQueryString,
    formatedCurrency,
    handleApiError,
    truncatedParagraph,
    getRandomImages,
    getCircularArray
};
