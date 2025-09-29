import { Fragment } from "react";

/**
 * BreadCrumbs component
 * This component dynamically generates a breadcrumbs navigation based on the current URL
 *
 * - Splits the url into segments
 * - The first setgment is always replaced with "home"
 * - Each breadcrumbs is a link except fot the last one because user currently in that
 *
 * @returns {JSX.Element} an orders list of breads crumbs links
 */
export default function Breadcrumbs({}) {
    
    const pathSegments = window.location.href
        .split("/")
        .filter(Boolean)
        .slice(2);
    if (pathSegments.length > 0) {
        pathSegments[0] = "home";
    }
    console.log(pathSegments);
    return (
        <ol className="flex text-h2 gap-3 text-[--Deep-Purple]">
            {pathSegments.map((segment, index) => {
                const currentHref =
                    "/" + pathSegments.slice(0, index + 1).join("/");
                const isLast = index === pathSegments.length - 1;
                return (
                    <Fragment key={index}>
                        <li>
                            {isLast ? (
                                <span>{segment}</span>
                            ) : (
                                <a href={currentHref}>{segment}</a>
                            )}
                        </li>
                        {!isLast && <span>/</span>}
                    </Fragment>
                );
            })}
        </ol>
    );
}
