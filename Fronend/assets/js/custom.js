function loadContent() {
    // Get the current hash (URL fragment)
    const hash = window.location.hash;

    console.log("Current Hash:", hash); // Log the current hash

    // Select the section for the current hash
    const section = document.querySelector(hash);

    // Log the section element
    console.log("Selected section:", section);

    // If the section has the 'data-load' attribute, load content
    if (section && section.hasAttribute('data-load')) {
        const url = section.getAttribute('data-load');

        // Check if content is already loaded in the section
        if (!section.innerHTML.trim()) {
            // Clear content from all sections before loading new content
            document.querySelectorAll('section').forEach(sec => {
                sec.innerHTML = ''; // Clear content of all sections
            });

            // Fetch and load content into the section
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    section.innerHTML = data; // Inject new content

                    // Scroll to the top of the page minus the nav height
                    const navHeight = document.querySelector('nav').offsetHeight; // Get nav height
                    window.scrollTo(0, navHeight);  // Scroll to the position under the nav
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                });
        }
    } else {
        console.error("No data-load attribute or section found for hash:", hash);
    }
}

// Initially load content for the current hash
loadContent();

// Listen for hash changes and reload the content dynamically
window.addEventListener('hashchange', function() {
    loadContent();
});
