import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import useNotification from "../hooks/useNoti";

export default function UsersNotifications() {
    const [notifications, setNotifications] = useState([]);

    const getTextClass = (status) =>
        ({
            success: "text-green-700",
            failed: "text-red-700",
            default: "text-[--text-default]",
        }[status] || "text-[--text-default]");

    useNotification(`App.Models.User.${window.userId}`, (notification) => {
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
