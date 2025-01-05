document.getElementById('menu1').addEventListener('click', () => {
    const boxContainer = document.getElementById('boxContainer');
    const boxName = prompt("Enter a name for the new box:");
    if (boxName) {
        const newBox = document.createElement('div');
        newBox.className = 'box';
        newBox.textContent = boxName;
        boxContainer.appendChild(newBox);
    }
});

