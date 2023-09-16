        document.addEventListener("DOMContentLoaded", function() {
    const messengerButton = document.getElementById("messengerbtn");
    const chatModule = document.getElementById("chat-frame");

    // Toggle chat module visibility on button click
    messengerButton.addEventListener("click", function() {
        chatModule.classList.toggle("hidden");
    });

    // Hide chat module when clicking anywhere on the page (except the messenger button)
    document.addEventListener("click", function(event) {
        if (event.target !== messengerButton && event.target !== chatModule) {
            chatModule.classList.add("hidden");
        }
    });

    // Prevent chat module from closing when clicking inside it
    chatModule.addEventListener("click", function(event) {
        event.stopPropagation();
    });
});