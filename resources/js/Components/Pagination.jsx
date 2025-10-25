import { memo } from "react";

function getPages(currentPage, lastPage, delta = 2) {
    const range = [];
    const rangeWithDots = [];
    let last;

    for (let i = 1; i <= lastPage; i++) {
        if (
            i === 1 ||
            i === lastPage ||
            (i >= currentPage - delta && i <= currentPage + delta)
        ) {
            range.push(i);
        }
    }

    for (let i of range) {
        if (last) {
            if (i - last === 2) {
                rangeWithDots.push(last + 1);
            } else if (i - last > 2) {
                rangeWithDots.push("...");
            }
        }
        rangeWithDots.push(i);
        last = i;
    }

    return rangeWithDots;
}

const Pagination = memo(({ paginationData, onPageChange }) => {
    const { current_page, last_page } = paginationData;

    if (last_page <= 1) return null;

    const pages = getPages(current_page, last_page);

    return (
        <div className="flex justify-center items-center gap-3 mt-8">
            <button
                onClick={() => onPageChange(current_page - 1)}
                disabled={current_page === 1}
                className={`px-4 py-2 rounded-full font-mer border transition-all ${
                    current_page === 1
                        ? "bg-gray-100 text-gray-400 cursor-not-allowed"
                        : "bg-white text-[--text-default] border-[--Pink-Primary]/30 hover:bg-[--Pink-Primary]/10"
                }`}
            >
                Prev
            </button>

            {pages.map((page, i) =>
                page === "..." ? (
                    <span
                        key={i}
                        className="px-3 py-2 text-[--text-muted] font-mer"
                    >
                        ...
                    </span>
                ) : (
                    <button
                        key={page}
                        onClick={() => onPageChange(page)}
                        className={`px-4 py-2 rounded-full border font-mer transition-all ${
                            page === current_page
                                ? "bg-[--Pink-Primary] text-[--White-Primary] shadow-md"
                                : "bg-white text-[--text-default] border-[--Pink-Primary]/30 hover:bg-[--Pink-Primary]/10"
                        }`}
                    >
                        {page}
                    </button>
                )
            )}

            <button
                onClick={() => onPageChange(current_page + 1)}
                disabled={current_page === last_page}
                className={`px-4 py-2 rounded-full font-mer border transition-all ${
                    current_page === last_page
                        ? "bg-gray-100 text-gray-400 cursor-not-allowed"
                        : "bg-white text-[--text-default] border-[--Pink-Primary]/30 hover:bg-[--Pink-Primary]/10"
                }`}
            >
                Next
            </button>
        </div>
    );
});

export default Pagination;
