window.onload = function()
{


	document.getElementById('emoji1').addEventListener("click", ols);
	
	



	let width = 500,
		height = 0,
		filter = 'none',
		streaming = false;

	const video = document.getElementById('video');
	const canvas = document.getElementById('canvas');
	const photos = document.getElementById('photos');
	const photo_button = document.getElementById('photo_button');
	const save_photo = document.getElementById('save_photo');

	navigator.mediaDevices.getUserMedia({video: true, audio: false})

	.then(function(stream){
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

	photo_button.addEventListener('click',function(e)
	{
		takepicture();
		e.preventDefault()
	}, false);

	save_photo.addEventListener('click',function(e)
	{
		savepic()
		e.preventDefault();
	}, false);


	function takepicture()
	{
		const context = canvas.getContext('2d');

		if (width && height) {
			canvas.width = width;
			canvas.height = height;

			context.drawImage(video, 0, 0, width, height);
		}
	}

	function savepic(){
		var dataURL = canvas.toDataURL();
		var	emoji = document.getElementById("emoji1").src;
		const form = document.createElement('form');
		form.action = 'webupload.php';
		form.method = 'post';
		const myogimage = document.createElement('input');
		const myoverlay = document.createElement('input');
		myogimage.type = 'hidden';
		myogimage.name = 'img64';
		myogimage.value = dataURL;
		myoverlay.type = 'hidden';
		myoverlay.name = 'emoji64';
		myoverlay.value = emoji;
		form.appendChild(myogimage);
		form.appendChild(myoverlay);
		document.body.appendChild(form);
		form.submit();
		}


		function ols()
		{
			//canvas,video
			alert('finally');
		}


		///////////////////////////



}



