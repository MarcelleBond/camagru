window.onload = function()
{

	// Global vars to user thro out script...

	let width = 500,
		height = 0,
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

	.then(function(stream){
		// conects you to the webcam

		video.srcObject = stream;

		video.play();
	})

	.catch(function(err){
		console.log(`Error: ${err}`);
	});

	video.addEventListener('canplay', function(e){
		if (!streaming) {

			height = video.videoHeight / (video.videoWidth / width);
			video.setAttribute('width',width);
			video.setAttribute('height',height);
			canvas.setAttribute('width',width);
			canvas.setAttribute('height',height);

			streaming = true;
		}
	}, false);

	// photo button event
	photo_button.addEventListener('click',function(e){
		photos.innerHTML = "";		
		takepicture();

		e.preventDefault()
	}, false);

	photo_filter.addEventListener('change', function(e){
		//set filter to users choice;
		
		filter = e.target.value;
		video.style.filter = filter;
		e.preventDefault()
	});
	//  take pic from canvas
	function takepicture()
	{
		//creating the canvas
		const context = canvas.getContext('2d');

		if (width && height) {
			// setting the canvas width and height
			canvas.width = width;
			canvas.height = height;
			// placeing an image from the video to the canvas
			context.drawImage(video, 0, 0, width, height);
			// creating an image from the canvas 
			const  imgUrl = canvas.toDataURL('image/png');
			// creating and img element to display one the page..
			const img = document.createElement('img');
			// set the image source 
			img.setAttribute('src', imgUrl);
			img.style.filter = filter;
			// ading images to the photo div
			photos.appendChild (img);
		}
	}

}