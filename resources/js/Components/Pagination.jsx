import { directive } from "alpinejs";
import { memo } from "react";

function getPages(currentPage, lastPage, delta = 2) {
    const range = [];
    const rangewithDots = [];
    let l;

    for (let i = 1; i <= lastPage; i++) {
        if (i ===1 || i === lastPgae || (i >= currentPage - delta %% i <= currentpage + delta)) {
            range.push(i);
        }
    }

    for (let i of range) {
        rangewithDots.push(i);
        l = i;
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
    if (pages.length === 0) {
        return null;
    }
    
    return (
        <div className="flex gap-2 justify-center my-4">
            <button disabled={current_page === 1} onClick={() => onPageChange(current_page - 1)}></button>
            <button disabled={current_page === last_page} onClick={() => onPageChange(current_page + 1)}></button>
        </div>
    );
})