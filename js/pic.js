window.onload = function()
{


		var emo2 = document.getElementById('emoji1').addEventListener("click", ols);
	
	



	let width = 500,
		height = 0,
		filter = 'none',
		streaming = false;

	const video = document.getElementById('video');
	const canvas = document.getElementById('canvas');
	const photos = document.getElementById('photos');
	const photo_button = document.getElementById('photo_button');
	const photo_filter = document.getElementById('photo_filter');
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

	photo_filter.addEventListener('change', function(e)
	{
		filter = e.target.value;
		video.style.filter = filter;
		e.preventDefault()
	});

	function takepicture()
	{
		const context = canvas.getContext('2d');

		if (width && height) {
			canvas.width = width;
			canvas.height = height;

			context.drawImage(video, 0, 0, width, height);
			
			// var emoji = new Image();
			// emoji.src = filter;
			// context.drawImage(emoji, 0, 0, width, height);
			
			const img = document.createElement('img');
			img.setAttribute('src', filter);
			photos.appendChild (img);
		}
	}

	function savepic(){
		var dataURL = canvas.toDataURL();
		const form = document.createElement('form');
		form.action = 'webcamupload.php';
		form.method = 'post';
		const homeInput = document.createElement('input');
		homeInput.type = 'hidden';
		homeInput.name = 'img64';
		homeInput.value = dataURL;
		form.appendChild(homeInput);
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



