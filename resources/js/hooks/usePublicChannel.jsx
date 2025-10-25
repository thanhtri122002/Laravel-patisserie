import { useEffect } from "react";

/**
 * a hook that is used for listening to public channel 
 * @param {string} channel 
 * @param {} event 
 * @param {fucntion} callback 
 */
export default function usePublicChannel (channel, event, callback) {
    useEffect(() => {
        if (!window.Echo || !channel) return;
        console.log(channel);
        const echoChannel = window.Echo.channel(channel) ;

        echoChannel.listen(event, callback);
        
        return () => {
            window.Echo.channel(channel).stopListening(event, callback);
        }
    }, [channel, event, callback])
}