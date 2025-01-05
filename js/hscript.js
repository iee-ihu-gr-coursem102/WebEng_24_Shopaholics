function toggleMenu() {
      const menu = document.getElementById('menuOptions');
      if (menu.style.display === 'block') {
        menu.style.display = 'none';
      } else {
        menu.style.display = 'block';
      }
    }

    // Close the menu if clicked outside
    document.addEventListener('click', function(event) {
      const menu = document.getElementById('menuOptions');
      const button = document.querySelector('.menu-button');
      if (!menu.contains(event.target) && event.target !== button) {
        menu.style.display = 'none';
      }
    });