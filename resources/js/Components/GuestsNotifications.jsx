import { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
/**
 * GuestsNotification
 * 
 * A floating notification component that displays a temporary message
 * for guests, with success or failure status styling. The notification
 * automatically disappears after 5 seconds.
 * 
 * @param {Object} props - Component props
 * @param {{ message: string }} props.NotiData - Notification data object containing the message to display.
 * @param {boolean} props.status - Status of the notification; `true` for success, `false` for failure.
 * 
 * @returns {JSX.Element} A floating notification element with animation using Framer Motion.
 */
export default function GuestsNotification({ NotiData, status }) {
    const [notification, setNotification] = useState(null);

    const getStatus = (status) =>
        ({
            true: "text-green-700",
            false: "text-red-700",
            default: "text-[--text-default]",
        }[status] || "text-[--text-default]");

    useEffect(() => {
        if (!NotiData?.message) return;
    
        setNotification(NotiData);
        console.log(notification);
        const timeout = setTimeout(() => {
            setNotification(null);
        }, 5000);

        return () => clearTimeout(timeout);
    }, [NotiData]);

    return (
        <div className="fixed top-10 left-1/2 transform -translate-x-1/2 flex flex-col justify-center items-center space-y-3 z-[100] pointer-events-none w-full">
            <AnimatePresence mode="wait">
                {notification && (
                    <motion.div
                        key={notification.message} 
                        initial={{ opacity: 0, y: 30 }}
                        animate={{ opacity: 1, y: 0 }}
                        exit={{ opacity: 0, y: 30 }}
                        transition={{ duration: 0.3 }}
                        className={`pointer-events-auto bg-white p-4 rounded-lg shadow-md ${getStatus(status)}`}
                    >
                        <p className="font-mer text-h3 text-center">{status === true ? "Success" : "Failed"}</p>
                        <p className="font-mer text-body text-center">
                            {notification.message}
                        </p>
                    </motion.div>
                )}
            </AnimatePresence>
        </div>
    );
}
