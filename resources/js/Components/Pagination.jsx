import { memo } from "react";

/**
 * Generates a pagination range with optional ellipses for skipped pages.
 *
 * @param {number} currentPage - The current active page number.
 * @param {number} lastPage - The total number of pages.
 * @param {number} [delta=2] - The number of pages to display on either side of the current page.
 * @returns {Array<number|string>} An array representing the pagination range, where numbers represent page numbers
 * and strings ('...') represent skipped ranges.
 */
function getPages(currentPage, lastPage, delta = 2) {
    const range = [];
    const rangewithDots = [];
    let l;

    for (let i = 1; i <= lastPage; i++) {
        if (i === 1 || i === lastPage || ( i >= currentPage - delta && i <= currentPage + delta )) {
            range.push(i);
        }
    }

    for (let i of range) {
        if (l) {
            if ( i - l === 2) {
                rangewithDots.push(l + 1);
            } else if (i -l > 2) {
                rangewithDots.push('...');
            }
        }
        rangewithDots.push(i);
        l = i;
    }

    return rangewithDots;
}

/**
 * Pagination component for rendering a paginated navigation interface.
 * 
 * @component
 * @param {Object} props - The props object.
 * @param {Object} props.paginationData - The pagination data object.
 * @param {number} props.paginationData.current_page - The current active page number.
 * @param {number} props.paginationData.last_page - The total number of pages.
 * @param {string|null} props.paginationData.next_page_url - The URL for the next page (if available).
 * @param {string|null} props.paginationData.prev_page_url - The URL for the previous page (if available).
 * @param {Function} props.onPageChange - Callback function to handle page changes. Receives the new page number as an argument.
 * 
 * @returns {JSX.Element|null} The rendered pagination component or null if there is only one page.
 */

const Pagination = memo(({paginationData, onPageChange}) => {

    const { current_page, last_page } = paginationData;

    if (last_page <=1 ) {
        return null;
    }

    const pages = getPages(current_page, last_page);

    if (pages.length === 0) {
        return null;
    }
    
    return (
        <div className="flex gap-2 justify-center my-4">
            <button disabled={current_page === 1} onClick={() => onPageChange(current_page - 1)}>Previous</button>
            
            {pages.map((page, index) => (
                page === "..." ? (
                    <span key={`dot-${index}`} className="px-4 py-2 text-gray-500">
                        ...
                    </span>
                ) : (
                    <button key={page} onClick={() => onPageChange(page)} className={`px-4 py-2 border rounded ${
                        current_page === page ? 'font-mer text-' : 'bg-white text-gray-700'
                    }`}>{page}</button>
                )
            ))}

            <button disabled={current_page === last_page} onClick={() => onPageChange(current_page + 1)}>Next</button>
        </div>
    );
});

export default Pagination;