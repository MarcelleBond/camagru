// Global vars to user thro out script...

let width = 500,
	hight = 0,
	filter = 'none',
	streaming = false;

// DOM Elements that are required to take pictures

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const photo_button = document.getElementById('photo_button');
const clear_button = document.getElementById('clear_button');
const photo_filter = document.getElementById('photo_filter');

// get the media stream to use the webcam

navigator.mediaDevices.getUserMedia({video: true, audio: false})

if (navigator.mediaDevices.getUserMedia) {       
    navigator.mediaDevices.getUserMedia({video: true})
  .then(function(stream) {
    video.srcObject = stream;
  })
  .catch(function(error) {
    console.log("Something went wrong!");
  });
}
