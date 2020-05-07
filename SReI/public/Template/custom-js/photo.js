/*$.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
*/

const video = document.getElementById('video');
var cv = document.querySelector("#videoCanvas");
var ctx = cv.getContext('2d');

const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: false,
  video: {width: 640, height: 360}
};

// Access webcam
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }
}

// Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
    video.onplay = function() {
      setTimeout(drw , 300);
    };
}

function drw() {
      //var video = document.querySelector("#webCamera");

      cv.width = video.videoWidth;
      cv.height = video.videoHeight;


      ctx.drawImage(video, 0, 0, cv.width, cv.height);

     
      ctx.stroke();


      setTimeout(drw , 20);
}

// Load init
init();