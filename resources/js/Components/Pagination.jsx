import { memo } from "react";

function getPages(currentPage, lastPage, delta = 2) {
    const range = [];
    const rangewithDots = [];
    let l;

    for (let i = 1; i <= lastPage; i++) {
        if (i ===1 || i === lastPage || (i >= currentPage - delta && i <= currentPage + delta)) {
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

const Pagination = memo(({paginationData, onPageChange}) => {
    const {current_page, last_page, next_page_url, prev_page_url} = paginationData;

    if (last_page <=1 ) {
        return null;
    }

    const pages = getPages(current_page, last_page);
    console.log('get pages', pages);
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