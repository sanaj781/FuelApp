// Getting current location

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    document.getElementById("position").value =
      "Geolocation is not supported by this browser.";
  }
}

// Showing current location
function showPosition(position) {
  document.getElementById("position").value =
    position.coords.latitude + " " + position.coords.longitude;
}

// Showing Modal
function setModal() {
  if (document.getElementById("isSent") !== null) {
    if (
      document.getElementById("isSent").value === "success" ||
      document.getElementById("isSent").value === "error"
    ) {
      let currentPage = window.location.toString().includes("start-ride")
        ? "start-ride"
        : "add-document";
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the <span> element that closes the modal
      var close = document.getElementById("close");

      modal.style.display = "flex";

      // When the user clicks on <span> (x), close the modal and redirect to the main page
      close.onclick = function () {
        modal.style.display = "none";

        location.href = "index.php?page=" + currentPage;
      };

      // When the user clicks anywhere outside of the modal, close it and redirect to main page
      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";
          location.href = "index.php?page=" + currentPage;
        }
      };
    }
  }
}

//Wyjazd słuzbowy czy prywatny
function checkTypeOfRide() {
  if (document.getElementById("typeOfRide").checked) {
    document.getElementById("delegation-wrapper").classList.remove("hidden");
  } else {
    document.getElementById("delegation-wrapper").classList.add("hidden");
    document.getElementById("administration_ride").required = false;
  }
}

//Delegacja czy wyjazd administracyjny
function checkTypeOfDelegationRide() {
  if (document.getElementById("delegation").checked) {
    document.getElementById("delegationNr-wrapper").classList.remove("hidden");
    document.getElementById("administration-wrapper").classList.add("hidden");
    document.getElementById("administration_ride").required = false;
  } else if (document.getElementById("administration").checked) {
    document
      .getElementById("administration-wrapper")
      .classList.remove("hidden");
    document.getElementById("administration_ride").required = true;

    document.getElementById("delegationNr-wrapper").classList.add("hidden");
  }
}

//Swiping Car Function
function SwipeCar(arg) {
  const myCarousel = document.getElementById("carouselExampleControls");
  location.href;
  myCarousel.addEventListener("slide.bs.carousel", (event) => {
    document.getElementsByClassName("carousel-item");
    if (event.direction === "left") changeCar("next");
    if (event.direction === "right") changeCar("prev");
  });

  //Sliding cars
  function changeCar(arg) {
    const SubmitCarButton = document.getElementById("SubmitCarButton");
    const arrayOfCars = document.getElementById("car_ids").value.split(",");
    let currentCarId =
      document.getElementsByClassName("active")[0].lastElementChild.value;
    let currentCarRegNr =
      document.getElementsByClassName("active")[0].children[
        document.getElementsByClassName("active")[0].children.length - 2
      ].value;
    let index = arrayOfCars.indexOf(currentCarId);
    swipe(arg);

    function swipe(arg) {
      const carhref = window.location.toString().includes("?page=")
        ? "&car="
        : "?car=";
      SubmitCarButton.classList.remove("hidden");
      SubmitCarButton.setAttribute(
        "href",
        window.location + carhref + currentCarId
      );
      SubmitCarButton.textContent = "Wybierz " + currentCarRegNr;
    }
  }
}
function Fileloader() {
  function showLoading() {
    document.getElementById("loading_gif").style = "visibility: visible";
  }
  $("#add_document").click(function () {
    if (
      $("#inputOddometer").val() &&
      $("#amount").val() &&
      $("#upload_image").val()
    ) {
      showLoading();
    }
  });
}
