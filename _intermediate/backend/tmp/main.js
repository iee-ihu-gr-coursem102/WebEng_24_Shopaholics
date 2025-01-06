fetch('api.php?action=getLists')
    .then(response => response.json())
    .then(data => {
        console.log(data); // Lists will be shown in the console
    });


fetch('api.php?action=addList', {
    method: 'POST',
    body: JSON.stringify({ title: 'Grocery List', category_id: 1 })
})
.then(response => response.json())
.then(data => {
    console.log(data.message); // Success or error message
});


fetch('api.php?action=getItems&list_id=1')
    .then(response => response.json())
    .then(data => {
        console.log(data); // Items for ListID = 1
    });



