import './bootstrap';

const url = 'http://localhost:8082/api/placetopay';

P.on('close', function () {
    console.log('Close Lightbox')
});

P.on('response', function (response) {
    console.log(response);
});


document.getElementById('open').addEventListener('click', async function () {
    try {
        const response = await fetch(url);
        const { placetopayUrl } = await response.json();
        P.init(placetopayUrl);
    } catch (error) {
        console.log(error)
    }
});
