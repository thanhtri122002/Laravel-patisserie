import { Transition } from '@headlessui/react';
import { useContext, useState, useReducer } from 'react';
import { createContext } from 'react';


const SideBarContext = createContext();

const SideBar = ({children}) => {
    const [open, setOpen] = useState(false);
    
    const toggleOpen = () =>{
        setOpen((previousState) => !previousState);
    };

    return (
        <SideBarContext.Provider value={{open, toggleOpen, setOpen}}>
            <div className="relative hidden md:block bg-red-800 ">{children}</div>
        </SideBarContext.Provider>
    )
}

const Trigger = ({children, ...props}) => {
    const { open, toggleOpen, setOpen } = useContext(SideBarContext);
    
    return (
        
        <div {...props} onClick={toggleOpen}>{children}</div>
        
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
                
                    <div className='fixed inset-0 z-50 mt-2 shadow-lg' onClick={() => setOpen(false)}>
                        <div className='bg-red'>{children}</div>
                    </div>  
            </Transition>
        </>
    )
}


SideBar.Trigger = Trigger;
SideBar.Content = Content;

export default SideBar;

