import { directive } from "alpinejs";
import { memo } from "react";

const Pagination = memo(({paginationData, onPageChange}) => {
    const {current_page, last_page, next_page_url, prev_page_url} = paginationData;

    if (last_page <=1 ) {
        return null;
    }

    return(
        
    );
})