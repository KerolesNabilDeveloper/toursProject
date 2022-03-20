
var messaging;

function getRegToken(argument) {

    saveToken("");

    messaging.getToken().then(function (currentToken) {
        if (currentToken) {
            saveToken(currentToken);
        }
        else {
            alert('Please refresh the page');
        }
    }).catch(function (err) {
        alert('Please refresh the page');
        console.log('An error occurred while retrieving token. ', err);
    });
}


function saveToken(currentToken) {

    if (currentToken === "") {
        var oldFirebaseToken = localStorage.getItem("firebase_token");

        if (oldFirebaseToken != null) {
            localStorage.setItem("firebase_token", oldFirebaseToken);
        }

        $(".firebase_notification_token").val(oldFirebaseToken);
        return;
    }

    localStorage.setItem("firebase_token", currentToken);
    $(".firebase_notification_token").val(currentToken);

    var obj        = {};
    obj._token     = _token;
    obj.push_token = currentToken;

    $.ajax({
        url: base_url2 + "/save_push_token",
        type: "POST",
        data: obj
    });

}

$(function(){

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

    if(navigator.serviceWorker != undefined){

        navigator.serviceWorker.register(base_url2+'/firebase-messaging-sw.js').then((registration) => {
            messaging = firebase.messaging();

            messaging.useServiceWorker(registration);

            messaging.requestPermission().then(function () {
                getRegToken();
            }).catch(function (err) {
                console.log('Unable to get permission to notify.', err);
            });

            messaging.onMessage(function (payload) {

                notificationTitle   = payload.data.title;
                notificationOptions = {
                    body: payload.data.body,
                    icon: payload.data.icon,
                    image: payload.data.image
                };
                var notification    = new Notification(notificationTitle, notificationOptions);

                notification.onclick = function(){
                    extraPayload = JSON.parse(payload.data.extraPayload);


                    if(extraPayload.url != undefined){
                        // location.href = extraPayload.url;
                        window.open(extraPayload.url,"_blank");
                    }
                };
            });

        });

    }

});
