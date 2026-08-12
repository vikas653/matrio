importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");

firebase.initializeApp({
   apiKey: "AIzaSyCwhieTiUOSEGqKVtfNzLzqWWf5w7ZCMgg",
  authDomain: "matrilovovr.firebaseapp.com",
  databaseURL: "https://matrilovovr-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "matrilovovr",
  storageBucket: "matrilovovr.firebasestorage.app",
  messagingSenderId: "694966825406",
  appId: "1:694966825406:web:ccbd9c4819f178342389ef"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function ({
    data: { title, body, icon },
}) {
    return self.registration.showNotification(title, { body, icon });
});
