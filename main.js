document.addEventListener("DOMContentLoaded", function () {
    // Add an event listener for the button
    document.getElementById("fetchDocumentsBtn").addEventListener("click", function () {
        // Fetch documents using AJAX
        fetchDocuments();
    });

    // Initial fetch when the page loads
    fetchDocuments();
});

function fetchDocuments() {
    // Fetch documents using AJAX
    fetch("fetch_documents.php")
        .then(response => response.json())
        .then(data => {
            // Display documents in the document list
            displayDocuments(data);
        })
        .catch(error => console.error('Error fetching documents:', error));
}

function displayDocuments(documents) {
    // Get the document list ul element
    const documentList = document.getElementById("document-list");

    // Clear the existing content
    documentList.innerHTML = "";

    // Populate the document list
    documents.forEach(document => {
        const listItem = document.createElement("li");
        listItem.textContent = `${document.filename} - Type: ${document.type} - Description: ${document.description}`;
        documentList.appendChild(listItem);
    });
}
