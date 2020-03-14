$.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });

const video = document.getElementById('video');
var canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
var send =document.getElementById('can');
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: false,
  video: {
    width: 640, height: 360
  }
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
}

// Load init
init();

// Draw image
var context = canvas.getContext('2d');

snap.addEventListener("click", function() {
        context.drawImage(video, 0, 0, 640, 360);
});

send.addEventListener("click", function () {
    context.drawImage(video, 0, 0, 640, 360);
    toBin();
    try {
        var dataUrl = canvas.toDataURL("image/png");

        $.ajax({
            url: '/photo',
            data:{
                img: dataUrl
            },
            type: 'POST',
            success: function(data)
            {
                alert("Imagen guardada en servidor");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    } catch(err) {
        alert(err);
    }
});

function toBin(){
  var imageData = context.getImageData(0, 0, 640, 360);
  var pixels = imageData.data;
  var numPixels = imageData.width * imageData.height;
  for ( var i = 0; i < numPixels; i++ ) {
      var r = pixels[ i * 4 ];
      var g = pixels[ i * 4 + 1 ];
      var b = pixels[ i * 4 + 2 ];

      var grey = ( r + g + b ) / 3;

      if (grey < 80 ){
        pixels[ i * 4 ] = 0;
        pixels[ i * 4 + 1 ] = 0;
        pixels[ i * 4 + 2 ] = 0;
      }else{
        pixels[ i * 4 ] = 255;
        pixels[ i * 4 + 1 ] = 255;
        pixels[ i * 4 + 2 ] = 255;
      }
  }

  context.putImageData( imageData, 0, 0 );

}
