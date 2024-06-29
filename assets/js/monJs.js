document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('addDiv0').addEventListener('click', function() {
        // Create a new div element
        var newDiv = document.createElement('div');
        newDiv.className = 'mr-3';
        newDiv.style.width = '250px';
        newDiv.style.height = '150px';
        newDiv.style.border = '1px solid #ccc';
        newDiv.style.borderRadius = '15px';
        
        // Append the new div before the icon
        var parentContainer = document.querySelector('#home'); // Utilisation de l'identifiant unique
        parentContainer.insertBefore(newDiv, this);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('addDiv1').addEventListener('click', function() {
        // Create a new div element
        var newDiv = document.createElement('div');
        newDiv.className = 'mr-3';
        newDiv.style.width = '250px';
        newDiv.style.height = '150px';
        newDiv.style.border = '1px solid #ccc';
        newDiv.style.borderRadius = '15px';
        
        // Append the new div before the icon
        var parentContainer = document.querySelector('#categories'); // Utilisation de l'identifiant unique
        parentContainer.insertBefore(newDiv, this);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Get all the icons with the id pattern 'add...'
    document.querySelectorAll('i[id^="add"]').forEach(function(icon) {
        icon.addEventListener('click', function(event) {
            var customSelect = document.getElementById('custom-select');
            // Toggle display
            if (customSelect.style.display === 'block') {
                customSelect.style.display = 'none';
            } else {
                customSelect.style.display = 'block';
                
                // Get mouse coordinates
                var x = event.clientX;
                var y = event.clientY;
                
                // Position the custom select element
                customSelect.style.position = 'absolute';
                customSelect.style.left = x + 'px';
                customSelect.style.top = y + 'px';
            }
        });
    });
});

