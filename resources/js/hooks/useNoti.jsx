import { useEffect } from "react";

/**
 * A custom hook that is listen to capture notification from the backend
 * 
 * @param {string} channel 
 * @param {function} callback 
 */
export default function useNotification(channel, callback) {
    useEffect(() => {
        if (!window.Echo || !channel) return;
        const echoChannel = window.Echo.private(channel);

        echoChannel.notification((notification) => callback(notification));

        return () => {};
    }, [channel, callback]);
}
