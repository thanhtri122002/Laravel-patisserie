initialize();

async function initialize() 
{
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const sessionId = urlParams.get('session_id');
    const response = await fetch('')
}