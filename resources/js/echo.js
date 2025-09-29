import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    cluster: import.meta.env.VITE_REVERB_APP_CLUSTER || 'mt1',
    wsHost: import.meta.env.VITE_REVERB_HOST.replace(/^https?:\/\//, ''), // hostname only
    wsPort: import.meta.env.VITE_REVERB_PORT,   // 6001
    wssPort: import.meta.env.VITE_REVERB_PORT,  // 6001
    forceTLS: import.meta.env.VITE_REVERB_SCHEME === 'https',
    disableStats: true,
});

