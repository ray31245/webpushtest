// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.3/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
    apiKey: "AIzaSyCfgBHK4_U1pizaeIGKG4azCEaDW_fbDIc",
    authDomain: "laravelpushtest.firebaseapp.com",
    databaseURL: "https://laravelpushtest.firebaseio.com",
    projectId: "laravelpushtest",
    storageBucket: "",
    messagingSenderId: "73632765795",
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();