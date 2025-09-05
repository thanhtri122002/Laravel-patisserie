// import { view } from "motion/react-client";
// import { useState, createContext, useContext } from "react";
// import { AnimatePresence, motion } from "motion/react";
// const TabContext = createContext();

// const Tabs = ({ children, tabs }) => {
//     const [mainIndex, setMainIndex] = useState(0);

//     return (
//         <TabContext.Provider value={{ tabs, mainIndex, setMainIndex }}>
//             {children}
//         </TabContext.Provider>
//     );
// };

// const List = ({ children }) => {
//     return (
//         <div className="flex justify-evenly p-3 items-center mx-auto">
//             {children}
//         </div>
//     );
// };

// const Trigger = ({ children }) => {
//     const { tabs, mainIndex, setMainIndex } = useContext(TabContext);

//     return (
//         <>
//             {tabs.map((tab, index) => (
//                 <div className="relative">
//                     <button
//                         onClick={() => setMainIndex(index)}
//                         className="relative z-10 px-4 py-2 rounded-lg"
//                     >
//                         {tab}
//                     </button>
//                     {mainIndex === index && (
//                         <motion.div
//                             layoutId="tab-background"
//                             className="absolute inset-0 rounded-lg bg-[--Pink-Secondary]"
//                         ></motion.div>
//                     )}
//                 </div>
//             ))}
//         </>
//     );
// };

// const Content = ({ children }) => {
//     const { mainIndex } = useContext(TabContext);

//     return (
//         <AnimatePresence mode="wait">
//             <motion.div
//                 key={mainIndex}
//                 layout
//                 layoutId="tabMainContent"
//                 className="p-6"
//                 initial={{ opacity: 0, y: 10 }}
//                 animate={{ opacity: 1, y: 0 }}
//                 exit={{ opacity: 0, y: -10 }}
//                 transition={{ duration: 0.3 }}
//             >
//                 {children[mainIndex]}
//             </motion.div>
//         </AnimatePresence>
//     );
// };

// Tabs.List = List;
// Tabs.Trigger = Trigger;
// Tabs.Content = Content;

// export default Tabs;


import { useState, createContext, useContext, Children } from "react";
import { AnimatePresence, motion } from "motion/react";

const TabContext = createContext();

const Tabs = ({ children }) => {
    const [mainIndex, setMainIndex] = useState(0);

    return (
        <TabContext.Provider value={{ mainIndex, setMainIndex }}>
            <div className="w-full">{children}</div>
        </TabContext.Provider>
    );
};

const List = ({ children }) => {
    // `Children.map` gives you access to each trigger
    return (
        <div className="flex justify-evenly p-3 items-center mx-auto">
            {Children.map(children, (child, index) => {
                
                return (
                    <div className="relative">
                        {child && { ...child, props: { ...child.props, index } }}
                    </div>
                );
            })}
        </div>
    );
};

const Trigger = ({ children, index }) => {
    const { mainIndex, setMainIndex } = useContext(TabContext);

    return (
        <div className="relative">
            <button
                onClick={() => setMainIndex(index)}
                className="relative z-10 px-4 py-2 rounded-lg"
            >
                {children}
            </button>
            {mainIndex === index && (
                <motion.div
                    layoutId="tab-background"
                    className="absolute inset-0 rounded-lg bg-[--Pink-Secondary]"
                />
            )}
        </div>
    );
};

const Content = ({ children }) => {
    const { mainIndex } = useContext(TabContext);

    return (
        <AnimatePresence mode="wait">
            <motion.div
                key={mainIndex}
                layout
                layoutId="tabMainContent"
                transition={{ type: "spring", duration: 0.4 }}
            >
                {Children.toArray(children)[mainIndex]}
            </motion.div>
        </AnimatePresence>
    );
};

Tabs.List = List;
Tabs.Trigger = Trigger;
Tabs.Content = Content;

export default Tabs;

