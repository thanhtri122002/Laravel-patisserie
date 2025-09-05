const debounce = (fn, delay) => {
    let timer;
    return (...args) => {
        clearTimeout(timer);

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
        return {
            data: null,
            errors: err.response.data?.errors || err.response.data,
        };
    }
    return { data: null, errors: { general: ["Something went wrong"] } };
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

const getCircularArray = (chosenEl, arr = []) => {
    const chosenElIndex = arr.indexOf(chosenEl);
    if (chosenElIndex === -1) return [];

    return [
        ...arr.slice(chosenElIndex),
        ...arr.slice(0,chosenElIndex)
    ]
}





export {
    debounce,
    makeQueryString,
    formatedCurrency,
    handleApiError,
    truncatedParagraph,
    getRandomImages
};
