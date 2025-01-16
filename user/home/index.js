const images = [
  "/assets/photos/imageHomePage2.jpg",
  "/assets/photos/ImageHomePage3.png",
  "/assets/photos/ImageHomePage4.jpg",
];

let currentIndex = 0;
const carousel = document.querySelector(".carousel img");
const prev = document.querySelector(".prev");
const next = document.querySelector(".next");

function updateImage(index) {
  carousel.src = images[index];
}

prev.addEventListener("click", () => {
  currentIndex = currentIndex > 0 ? currentIndex - 1 : images.length - 1;
  updateImage(currentIndex);
});

next.addEventListener("click", () => {
  currentIndex = currentIndex < images.length - 1 ? currentIndex + 1 : 0;
  updateImage(currentIndex);
});
