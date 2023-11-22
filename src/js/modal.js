function clickHandler(){
    var modal = document.getElementById("modal");
    modal.style.display = "none";
    // Add logic to update the URL when closing the modal
    updateUrl('');
};

var modalClose = document.getElementById("modal-close");
modalClose.addEventListener("click", clickHandler)




// Function to update the URL
function updateUrl(param) {
    // Get the current URL
    var currentUrl = window.location.href;

    // Remove the existing "msg" parameter, if any.
    var updatedUrl = currentUrl.replace(/[\?&]msg=[^&]+/, '');

    // Add the new "msg" parameter
    updatedUrl += (param ? (updatedUrl.includes('?') ? '&' : '?') + param : '');

    // Update the URL
    window.history.replaceState({}, '', updatedUrl);
}