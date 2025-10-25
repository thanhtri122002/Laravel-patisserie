import { createContext, useContext, forwardRef } from "react";
import { motion, AnimatePresence } from "motion/react";

const ModalContext = createContext();

const Modal = ({children, open, setIsOpen, toggleOpen}) => {
    
    return (
        <ModalContext.Provider value={{ open, setIsOpen, toggleOpen }}>
            {children}
        </ModalContext.Provider>
    )
}

const Trigger = ({children, className, ...props}) => {
    const { toggleOpen } = useContext(ModalContext);

    return (
        <>
            <div className={className} onClick={toggleOpen}>{children}</div>
        </>
        
    )
}

const Content = forwardRef((({children, className, ...props}, ref) => {
    const {open, setIsOpen} = useContext(ModalContext);

    return (
        <AnimatePresence mode="wait">
            {open && (
                <motion.div className="fixed bottom-0 left-0 right-0 z-50">
                    <motion.div
                        key='backdrop'
                        className="fixed inset-0 bg-black/50"
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        exit={{ opacity: 0 }}
                        onClick={() => setIsOpen(false)}
                    />

                    <motion.div
                        ref={ref}
                        key="panel"
                        className={`overflow-y-auto fixed bottom-0 left-0 right-0 h-[70dvh] bg-white rounded-t-xl z-[100] ${className}`}
                        
                        transition={{ type: "spring", damping: 20 }}
                    >
                    
                        <div className={className}>
                            {children}
                        </div>
                        
                    </motion.div>
                </motion.div> 
            ) }
        </AnimatePresence>
        
    )
}))

const MotionContent = motion(Content);

Modal.Trigger = Trigger;
Modal.Content = MotionContent;

export default Modal;