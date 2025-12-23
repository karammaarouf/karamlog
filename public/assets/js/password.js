document.addEventListener("DOMContentLoaded", function() {
    var showHideElements = document.querySelectorAll(".show-hide");

    showHideElements.forEach(function(showHideDiv) {
        var showHideSpan = showHideDiv.querySelector("span");
        // Find the input relative to the show-hide div
        // Assuming the structure is: input + div.show-hide inside a container
        var container = showHideDiv.parentElement;
        var passwordInput = container.querySelector("input");

        if (showHideSpan && passwordInput) {
            // Initial state
            showHideDiv.style.display = "block";
            
            showHideSpan.addEventListener("click", function() {
                if (showHideSpan.classList.contains("show")) {
                    passwordInput.setAttribute("type", "text");
                    showHideSpan.classList.remove("show");
                } else {
                    passwordInput.setAttribute("type", "password");
                    showHideSpan.classList.add("show");
                }
            });

            // Reset on submit if needed (optional, keeping previous logic intent)
            var form = passwordInput.closest('form');
            if (form) {
                form.addEventListener('submit', function() {
                     showHideSpan.classList.add("show");
                     passwordInput.setAttribute("type", "password");
                });
            }
        }
    });
});
