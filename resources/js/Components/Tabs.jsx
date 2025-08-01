import { a, div, title } from "motion/react-client";
import { useState } from "react";


export default function Tabs ({ titles, dataTitles, children, className, ...props }) {
    const [ activeTab, setActiveTab ] = useState(titles[0]);

    const handleChangeActiveTab = (selectedTab) => {
        setActiveTab(selectedTab)
    }

    return (
        <>
            <div className="flex justify-center items-center gap-x-4 py-8">
                {titles.map((title, index) => (
                    <a className="relative no-underline px-4 py-2 mx-3" key={index} data-title={title} onClick={() => handleChangeActiveTab(title)}>{title}</a>
                ))}
            </div>
            <div className="">
                {children.map((child, index) => (
                    <div key={index} className={titles[index] === activeTab ? "active" : "hidden"}>
                        {child}
                    </div>
                ))}
            </div>
        </>
    )


}