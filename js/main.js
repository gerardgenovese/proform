
// Initialize Firebase
var config = {
  apiKey: "AIzaSyAk3Wy6MkugnLBJUDHd5nq5MDcuHEvM8Ng",
  authDomain: "proform-llc.firebaseapp.com",
  databaseURL: "https://proform-llc.firebaseio.com",
  projectId: "proform-llc",
  storageBucket: "proform-llc.appspot.com",
  messagingSenderId: "851828302249"
};
firebase.initializeApp(config);

//Reference messages collection
var messagesRef = firebase.database().ref('messages');

//Listen for form submit
document.getElementById('contactForm').addEventListener('submit', submitForm);

//Submit Form
function submitForm(e) {
  e.preventDefault();
  
  //get values
  var name = getInputVal('name');
  var email = getInputVal('email');
  var phone = getInputVal('phone');
  var message = getInputVal('message');

  //Save Message
  saveMessage(name, email, phone, message);

  //Show Alert
  document.querySelector('.alert').style.display = 'block';

  //Hide Alert after 3 seconds
  setTimeout(function(){
  document.querySelector('.alert').style.display = 'none';
  }, 3000);

  //Clear Form
  document.getElementById('contactForm').reset();
}

//Function to get get form values
function getInputVal(id) {
  return document.getElementById(id).value;
}

//Save message to firebase
function saveMessage(name, email, phone, message) {
  var newMessageRef = messagesRef.push();
  newMessageRef.set({
      name: name,
      email: email,
      phone: phone,
      message: message
  });
}





