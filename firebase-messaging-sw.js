importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-messaging.js');

/*Update this config*/
var config = {
    apiKey: "AIzaSyA0x02IvLp7M4WflE4eX5-VHeTwgiz77Hc",
    authDomain: "maikros-site-326621.firebaseapp.com",
    projectId: "maikros-site-326621",
    storageBucket: "maikros-site-326621.appspot.com",
    messagingSenderId: "134123930501",
    appId: "1:134123930501:web:17348a2c46a690ba07baec",
    measurementId: "G-JD5EKN9EXS"
};

firebase.initializeApp(config);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {

    // Customize notification here
    const notificationTitle   = payload.data.title;
    const notificationOptions = {
        body: payload.data.body,
        icon: payload.data.icon,
        image: payload.data.image
    };

    self.addEventListener('notificationclick', function(event) {
        let url = 'http://maikros.com/';

        extraPayload = JSON.parse(payload.data.extraPayload);

        if(extraPayload.url != undefined){
            url = extraPayload.url;
        }

        event.notification.close(); // Android needs explicit close.
        event.waitUntil(
            clients.matchAll({type: 'window'}).then( windowClients => {
                // Check if there is already a window/tab open with the target URL
                for (var i = 0; i < windowClients.length; i++) {
                    var client = windowClients[i];
                    // If so, just focus it.
                    if (client.url === url && 'focus' in client) {
                        return client.focus();
                    }
                }
                // If not, then open the target URL in a new window/tab.
                if (clients.openWindow) {
                    return clients.openWindow(url);
                }
            })
        );
    });

    return self.registration.showNotification(notificationTitle,notificationOptions);
});


