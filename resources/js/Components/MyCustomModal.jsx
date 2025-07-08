import { Transition, Dialog, DialogPanel } from "@headlessui/react";
import { createContext, useContext, useState } from "react";


const ModalContext = createContext();

const Modal = ({ children }) => {
    const [ open, setIsOpen ] = useState(false);

    const toggleModal = () => {
        setIsOpen((prevState) => !prevState);
    }
    
    return (
        <ModalContext.Provider value={{open, setIsOpen, toggleModal }}>
            {children}
        </ModalContext.Provider>
    )
}

const Trigger = ({ children , ...props }) => {
    const { open , setIsOpen, toggleModal} = useContext(ModalContext);

    return (
        <div {...props} onClick={toggleModal}>{children}</div>
    )
}

const Content = ({children, ...props}) => {
    const { open, setIsOpen, toggleModal } = useContext(ModalContext);
    
    return (
        <Transition
            show={open}
            enter="transition-opacity ease-out duration-200"
            enterFrom="opacity-0"
            enterTo="opacity-100"
            leave="transition-opacity ease-in duration-150"
            leaveFrom="opacity-100"
            leaveTo="opacity-0"
        >
            <div className='fixed inset-0 bg-black opacity-35 z-100'></div>
        </Transition>
    )
}