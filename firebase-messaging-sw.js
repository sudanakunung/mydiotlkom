// [START initialize_firebase_in_sw]
// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.18.0/firebase-messaging.js');
// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyBvucMo2z2buOBM-JFec7ydGVOz_bdMaq8",
    authDomain: "mydio-sing-536c2.firebaseapp.com",
    databaseURL: "https://mydio-sing-536c2.firebaseio.com",
    projectId: "mydio-sing-536c2",
    storageBucket: "mydio-sing-536c2.appspot.com",
    messagingSenderId: "292287579277",
    appId: "1:292287579277:web:bddfc74849239b0c1b4ec4",
    measurementId: "G-YNX5NWR6E6"
});
// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

// If you would like to customize notifications that are received in the
// background (Web app is closed or not in browser focus) then you should
// implement this optional method.
// [START background_handler]
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notificationOption = {
        body: payload.message,
        icon: "https://app.mydiosing.com/assets/images/logo-md.png"
    };

    self.addEventListener('notificationclick', function (event) {
        console.log(event.notification.uri);
        if (!event.action) {
            // Was a normal notification click
            console.log('Notification Click.');
            self.clients.openWindow("https://app.mydiosing.com/", '_blank')
            event.notification.close();
            return;
        } else {
            event.notification.close();
        }
    });

    return self.registration.showNotification(payload.title, notificationOption);
});
// [END background_handler]