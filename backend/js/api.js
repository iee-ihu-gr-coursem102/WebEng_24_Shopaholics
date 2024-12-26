document.addEventListener("DOMContentLoaded", () => {
    // Buttons
    const fetchListsBtn = document.getElementById("fetchListsBtn");
    const addListBtn = document.getElementById("addListBtn");
    const fetchItemsBtn = document.getElementById("fetchItemsBtn");
    const addItemBtn = document.getElementById("addItemBtn");

    // Event Listeners
    fetchListsBtn.addEventListener("click", fetchLists);
    addListBtn.addEventListener("click", addList);
    fetchItemsBtn.addEventListener("click", fetchItems);
    addItemBtn.addEventListener("click", addItem);

    // API Base URL
    const API_URL = "api.php";

    // Fetch all shopping lists
    function fetchLists() {
    fetch(`${API_URL}?action=getLists`)
    .then(response => response.json())
    .then(data => {
        const listContainer = document.getElementById("listContainer");
        listContainer.innerHTML = '';
        if (data.status === 'success') {
            data.data.forEach(list => {
                // Default icon path if Icon is undefined
                const iconPath = list.Icon ? 
                    (list.Icon.startsWith('http') ? list.Icon : `http://localhost/shopaholics/${list.Icon}`) : 
                    'http://localhost/shopaholics/img/default-icon.png';

                listContainer.innerHTML += `
                    <li>${list.Title} (ID: ${list.ListID}) 
                        <img src="${iconPath}" alt="Category Icon" style="width:50px;height:50px;">
                    </li>`;
            });
        } else {
            alert('Error fetching lists: ' + data.message);
        }
    })
    .catch(error => console.error('Fetch error:', error));


    }

    // Add a new list
    function addList() {
        const title = document.getElementById("listTitle").value;
        const category_id = document.getElementById("listCategory").value;

        fetch(`${API_URL}?action=addList`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ title, category_id })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("addListMessage").innerText = data.message;
            fetchLists(); // Refresh the lists
        });
    }

    // Fetch items for a specific list
    function fetchItems() {
        const listID = document.getElementById("listID").value;

        fetch(`${API_URL}?action=getItems&list_id=${listID}`)
            .then(response => response.json())
            .then(data => {
                const itemContainer = document.getElementById("itemContainer");
                itemContainer.innerHTML = ''; // Clear items
                if (data.status === 'success') {
                    data.data.forEach(item => {
                        itemContainer.innerHTML += `<li>${item.name} - ${item.quantity} ${item.measuring_unit}</li>`;
                    });
                } else {
                    alert('Error fetching items: ' + data.message);
                }
            });
    }

    // Add a new item to a list
    function addItem() {
        const list_id = document.getElementById("itemListID").value;
        const name = document.getElementById("itemName").value;
        const quantity = document.getElementById("itemQuantity").value;
        const unit = document.getElementById("itemUnit").value;

        fetch(`${API_URL}?action=addItem`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ list_id, name, quantity, unit })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("addItemMessage").innerText = data.message;
            fetchItems(); // Refresh items for the list
        });
    }
});

