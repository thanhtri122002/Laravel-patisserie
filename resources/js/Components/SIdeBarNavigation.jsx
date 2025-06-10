import { Transition } from '@headlessui/react';
import { useContext, useState, useReducer } from 'react';


const SideBarContext = createContext();

const SideBar = ({children}) => {
    const [open, setOpen] = useState(false);
    
    const toggleOpen = () =>{
        setOpen((previousState) => !previousState);
    };

    return (
        <SideBarContext.Provider value={{open, toggleOpen, setOpen}}>
            <div className="relative">{children}</div>
        </SideBarContext.Provider>
    )
}

const Trigger = ({children}) => {
    const { open, toggleOpen, setOpen } = useContext(SideBarContext);
    
    return (
        <>enterFrom="opacity-0"
            <div onClick={toggleOpen}>{children}</div>
            {
                open && (
                    <div className='fixed inset-0 z-40' onClick={setOpen(false)}></div>
                )
            }
        </>
    )
}

const Content = ({children}) => {
    const { open, toggleOpen, setOpen } = useContext(SideBarContext);

    return (
        <>
            <Transition
                show={open}
                enter='transition-transform ease-linear duration-200'
                enterFrom="translate-x-full"
                enterTo='translate-x-0'
                leave='transition-transform ease-linear duration-200'
                leaveFrom="translate-x-0"
                leaveTo='translate-x-full'
                >
                
                    <div className='fix'></div>
            </Transition>
        </>
    )
}

