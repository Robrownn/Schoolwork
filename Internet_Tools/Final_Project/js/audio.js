var context;
window.addEventListener('load', init, false);

function init() {
  try {
    window.AudioContext = window.AudioContext||window.webkitAudioContext;
    context = new AudioContext();
  } catch(e) {
    alert('Web Audio API is not supported in this browser');
  }
}

var audioSample = null;

function loadSound(url) {
  var request = new XMLHttpRequest();
  request.open('GET', url, true);
  request.responseType = 'arraybuffer';

  request.onload = function() {
    context.decodeAudioData(request.response, function(buffer) {
      audioSample = buffer;
    }, onError);
  }
  request.send();
}
