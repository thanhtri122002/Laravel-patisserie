import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import useNotification from "../hooks/useNoti";
/**
 * UsersNotifications
 * 
 * A React component that displays real-time notifications for the current user.
 * Notifications are received via a custom `useNotification` hook (Laravel Echo / Reverb)
 * and automatically disappear after 8 seconds.
 * 
 * Each notification is animated using Framer Motion and styled based on its status.
 * 
 * @component
 * 
 * @example
 * <UsersNotifications />
 * 
 * @returns {JSX.Element} A floating list of notifications positioned at the bottom-right of the screen.
 */
export default function UsersNotifications() {
    const [notifications, setNotifications] = useState([]);

    const getTextClass = (status) =>
        ({
            success: "text-green-700",
            failed: "text-red-700",
            default: "text-[--text-default]",
        }[status] || "text-[--text-default]");

    useNotification(`App.Models.User.${window.userId}`, (notification) => {
        console.log(notification);
        console.log(notification.data);
        const payload = notification.data || notification;
        setNotifications((prev) => [payload, ...prev]);

        setTimeout(() => {
            setNotifications((prev) => prev.filter((t) => t.id !== payload.id));
        }, 8000);
    });

    return (
        <div className="fixed bottom-20 right-[7dvh] flex flex-col items-center justify-center space-y-3 z-[100] pointer-events-none w-full max-w-xs">
            <AnimatePresence>
                {notifications.map((noti) => (
                    <motion.div
                        key={noti.id}
                        initial={{ opacity: 0, y: 30, }}
                        animate={{ opacity: 1, y: 0, }}
                        exit={{ opacity: 0, y: 30, }}
                        transition={{ duration: 0.3 }}
                        className={`pointer-events-auto bg-white p-4 rounded-lg shadow-md ${getTextClass(
                            noti.status
                        )}`}
                    >
                        <p className="font-mer text-h3 text-center">
                            {noti.status?.toUpperCase() || "INFO"}
                        </p>
                        <p className="font-mer text-body text-center">{noti.Message}</p>
                    </motion.div>
                ))}
            </AnimatePresence>
        </div>
    );
}
