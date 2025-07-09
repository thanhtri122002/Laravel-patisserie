import { Transition } from '@headlessui/react';
import { useContext, useState, createContext } from 'react';

const SideBarContext = createContext();

/**
 * SideBar component to provide context and manage open/close state
 *
 * @component
 * @param {object} props
 * @param {React.ReactNode} props.children - Children components
 * @returns {JSX.Element}
 */
const SideBar = ({ children }) => {
    const [open, setOpen] = useState(false);

    /**
     * Toggle sidebar open/close
     */
    const toggleOpen = () => {
        setOpen((previousState) => !previousState);
    };

    return (
        <SideBarContext.Provider value={{ open, toggleOpen, setOpen }}>
            <div className="relative hidden md:block bg-red-800">{children}</div>
        </SideBarContext.Provider>
    );
};

/**
 * Trigger component to open or close the sidebar
 *
 * @component
 * @param {object} props
 * @param {React.ReactNode} props.children - Children (usually a button or icon)
 * @returns {JSX.Element}
 */
const Trigger = ({ children, ...props }) => {
    const { toggleOpen } = useContext(SideBarContext);

    return (
        <div {...props} onClick={toggleOpen}>
            {children}
        </div>
    );
};

/**
 * Content component to display the sidebar content with transition
 *
 * @component
 * @param {object} props
 * @param {React.ReactNode} props.children - Sidebar content
 * @returns {JSX.Element}
 */
const Content = ({ children }) => {
    const { open, setOpen } = useContext(SideBarContext);

    /**
     * Close sidebar when clicking on overlay
     */
    const close = () => setOpen(false);

    return (
        <>
            {/* Overlay backdrop */}
            <Transition
                show={open}
                enter="transition-opacity duration-200"
                enterFrom="opacity-0"
                enterTo="opacity-50"
                leave="transition-opacity duration-200"
                leaveFrom="opacity-50"
                leaveTo="opacity-0"
            >
                <div
                    className="fixed inset-0 bg-black z-40"
                    onClick={close}
                ></div>
            </Transition>

            {/* Sidebar panel */}
            <Transition
                show={open}
                enter="transition-transform duration-300"
                enterFrom="translate-x-full"
                enterTo="translate-x-0"
                leave="transition-transform duration-300"
                leaveFrom="translate-x-0"
                leaveTo="translate-x-full"
            >
                <div className="fixed top-0 right-0 h-full bg-white shadow-lg z-50 w-64 overflow-y-auto">
                    {children}
                </div>
            </Transition>
        </>
    );
};

// Attach Trigger and Content as subcomponents
SideBar.Trigger = Trigger;
SideBar.Content = Content;

export default SideBar;
