// --- Task Three --- //
const img = window.slider;
const length = 5;
let current = 0;
let intervalId = null;

function prev() {
  const resume = isPlaying();
  pause();
  current = current === 0 ? length : current - 1;
  img.src = `assets/image-${current}.png`;
  if (resume) play();
}

function next() {
  const resume = isPlaying();
  pause();
  current = current === length ? 0 : current + 1;
  img.src = `assets/image-${current}.png`;
  if (resume) play();
}

function play() {
  if (!isPlaying()) intervalId = setInterval(next, 1000);
}

function pause() {
  clearInterval(intervalId);
  intervalId = null;
}

function isPlaying() {
  return Boolean(intervalId);
}

play();
