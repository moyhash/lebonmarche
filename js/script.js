
function goBack() {
  window.history.back();
}

function confirmDelete(item) {
  // Display confirmation dialog
  if (confirm(`Are you sure you want to delete ${item}?`)) {
    // User clicked "OK"
    alert(`${item} has been deleted.`);
    // Perform deletion logic here, e.g., send a request to the server
  } else {
    // User clicked "Cancel"
    alert(`Deletion of ${item} was canceled.`);
  }
}


/*$(function () {
  $('.deitails-design').slick({
     dots: true,
     slidesToShow: 4,
     slidesToScroll: 1,
     arrows: true
  });
});*/

//////////////////////////////////////////////////////////////////////

// Model Button Close
let close1 = document.getElementById("close1");
let model = document.querySelector(".unmodel");
//let close = document.querySelector("#close1");
close1.addEventListener("click", (eo) => {
  close1.style.display = "none";
  model.style.display = "none";
});
/////////////// End Model ///////////////////////////////

// Active Thumbnail
/*function myFunction() {
  let mode = document.querySelectorAll(".thumbnail");
  mode.forEach((item) => {
    item.addEventListener("click", (eo) => {
      for (var i = 0; i < mode.length; i++) {
        mode[i].classList.remove("Active");
      }
      item.classList.add("Active");
    });
  });
}*/

/*
// Get the modal
let modal = document.getElementById("myModal");
// Get the modal image element
var modalImg = document.getElementById("modalImage");
// Get all images with class 'large-image' and add click event listeners to them
var images = document.getElementsByClassName('large-image');

for (var i = 0; i < images.length; i++) {
  images[i].onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src; // Set the modal image source to the clicked image source
  }
}*/
