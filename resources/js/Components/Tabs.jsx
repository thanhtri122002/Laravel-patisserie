import { useState, createContext, useContext } from "react";
import { AnimatePresence, motion } from "motion/react";

/**
 * Context used to share tab data and state between components.
 * @typedef {Object} TabContextType
 * @property {string[]} tabs - The list of tab labels.
 * @property {number} mainIndex - The index of the currently active tab.
 * @property {function(number): void} setMainIndex - Function to update the active tab index.
 */
const TabContext = createContext();

/**
 * Tabs component — provides shared context for tab triggers and content.
 *
 * @component
 * @param {Object} props
 * @param {React.ReactNode} props.children - Child components (`Tabs.List`, `Tabs.Trigger`, `Tabs.Content`).
 * @param {string[]} props.tabs - Array of tab labels.
 * @returns {JSX.Element}
 *
 * @example
 * <Tabs tabs={['Overview', 'Details', 'Reviews']}>
 *   <Tabs.List>
 *     <Tabs.Trigger />
 *   </Tabs.List>
 *   <Tabs.Content>
 *     {[<Overview />, <Details />, <Reviews />]}
 *   </Tabs.Content>
 * </Tabs>
 */
const Tabs = ({ children, tabs }) => {
    const [mainIndex, setMainIndex] = useState(0);

    return (
        <TabContext.Provider value={{ tabs, mainIndex, setMainIndex }}>
            {children}
        </TabContext.Provider>
    );
};

/**
 * Tabs.List — container for the tab triggers
 *
 * @component
 * @param {Object} props
 * @param {React.ReactNode} props.children - The tab triggers to render inside the list.
 * @param {string} [props.className] - Optional Tailwind or custom class names.
 * @returns {JSX.Element}
 */
const List = ({ children, className }) => {
    return (
        <div className={`flex p-3 justify-center items-center space-x-8 ` + className}>
            {children}
        </div>
    );
};

/**
 * Tabs.Trigger — renders all tab buttons dynamically from the `tabs` array.
 *
 * Description: use framer motion to define the animation switching background from old to new mainInex
 *
 * @component
 * @returns {JSX.Element}
 */
const Trigger = () => {
    const { tabs, mainIndex, setMainIndex } = useContext(TabContext);

    return (
        <>
            {tabs.map((tab, index) => (
                <div key={index} className="relative">
                    <button
                        onClick={() => setMainIndex(index)}
                        className="relative z-10 px-4 py-2 rounded-lg font-mer text-[--text-default]"
                    >
                        {tab}
                    </button>
                    {mainIndex === index && (
                        <motion.div
                            layoutId="tab-background"
                            className="absolute inset-0 rounded-lg bg-[--Pink-Secondary]"
                        ></motion.div>
                    )}
                </div>
            ))}
        </>
    );
};

/**
 * Tabs.Content — displays content corresponding to the active tab.
 * 
 * @component
 * @param {Object} props
 * @param {React.ReactNode[]} props.children - An array of tab contents; each index matches a tab in `tabs`.
 * @returns {JSX.Element}
 */
const Content = ({ children }) => {
    const { mainIndex } = useContext(TabContext);

    return (
        <AnimatePresence mode="wait">
            <motion.div
                key={mainIndex}
                layout
                layoutId="tabMainContent"
                className="p-6"
                initial={{ opacity: 0, y: 10 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, y: -10 }}
                transition={{ duration: 0.3 }}
            >
                {children[mainIndex]}
            </motion.div>
        </AnimatePresence>
    );
};

Tabs.List = List;
Tabs.Trigger = Trigger;
Tabs.Content = Content;

export default Tabs;

/**
 * Note
 * 1/ the children in the Content component is the tag that is directly chilrend of the motion.div
 */

