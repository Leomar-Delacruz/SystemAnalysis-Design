document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("fetchDocumentsBtn").addEventListener("click", function () {
        fetchDocuments();
    });

    document.getElementById("fetchAnotherSystemBtn").addEventListener("click", function () {
        fetchAnotherSystem();
    });

    function fetchDocuments() {
        fetch("get_documents.php")
            .then(response => response.json())
            .then(data => {
                updateDocumentList(data);
            })
            .catch(error => {
                console.error("Error fetching documents:", error);
            });
    }

    function fetchAnotherSystem() {
        console.log("Fetching documents for another system...");

        // For demonstration, let's display a message
        const documentList = document.getElementById("document-list");
        documentList.innerHTML = "<li>Documents for Another System will be displayed here.</li>";
    }

    function updateDocumentList(documents) {
        const documentList = document.getElementById("document-list");
        documentList.innerHTML = ""; // Clear existing list

        documents.forEach(document => {
            const listItem = document.createElement("li");
            listItem.innerHTML = `
                <strong>${document.type}</strong>
                <p>${document.description}</p>
                <a href="download.php?filename=${document.filename}" target="_blank">Download</a>
            `;
            documentList.appendChild(listItem);
        });
    }
});
