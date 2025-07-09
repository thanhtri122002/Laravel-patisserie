import { Transition, TransitionChild } from "@headlessui/react";
import { createContext, useContext } from "react";


const ModalContext = createContext();

const Modal = ({ children, open, setIsOpen, toggleOpen }) => {
    
    return (
        <ModalContext.Provider value={{open, setIsOpen, toggleOpen }} className="z-20">
            {children}
        </ModalContext.Provider>
    )
}

const Trigger = ({ children , ...props }) => {
    const { toggleOpen } = useContext(ModalContext);

    return (
        <>
            <div {...props} onClick={toggleOpen}>{children}</div>
            {open && (
                <div
                    className="fixed inset-0 z-40"
                    onClick={() => setOpen(false)}
                ></div>
            )}
        </>
    )
}

const Content = ({ children, ...props }) => {
    const { open, setIsOpen } = useContext(ModalContext);

    return (
      <Transition show={open}>
        <TransitionChild
          enter="ease-out duration-300"
          enterFrom="opacity-0"
          enterTo="opacity-100"
          leave="ease-in duration-200"
          leaveFrom="opacity-100"
          leaveTo="opacity-0"
        >
          <div
            onClick={() => setIsOpen(false)}
            className="fixed inset-0 bg-black/50"
          />
        </TransitionChild>
  
        <TransitionChild
          enter="ease-out duration-300"
          enterFrom="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enterTo="opacity-100 translate-y-0 sm:scale-100"
          leave="ease-in duration-200"
          leaveFrom="opacity-100 translate-y-0 sm:scale-100"
          leaveTo="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div className="fixed inset-0 flex items-center justify-center p-4" {...props}>
            <div className="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
              {children}
            </div>
          </div>
        </TransitionChild>
      </Transition>
    );
  };
  

Modal.Trigger = Trigger;
Modal.Content = Content;

export default Modal;