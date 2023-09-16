const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

let currentMonthIndex = 7; // Initial index for August

function updateMonthName() {
    const monthNameElement = document.getElementById('month-name');
    monthNameElement.textContent = monthNames[currentMonthIndex];
}

function addColumnLeft() {
    currentMonthIndex--;
    if (currentMonthIndex < 0) {
        currentMonthIndex = 11; // Wrap around to December
    }

    updateMonthName();

    // Add your existing add column code here...
}

function addColumnRight() {
    currentMonthIndex++;
    if (currentMonthIndex > 11) {
        currentMonthIndex = 0; // Wrap around to January
    }

    updateMonthName();

    // Add your existing add column code here...
}

document.getElementById('left-button').addEventListener('click', addColumnLeft);
document.getElementById('right-button').addEventListener('click', addColumnRight);


//manager
// Assuming you have an endpoint to fetch member data from the server
const endpoint = '/massier/php/mealDetailsManager.php';

// Function to populate the select dropdown
function populateSelect() {
    const select = document.getElementById('member-select');

    // Fetch member data from the server
    fetch(endpoint)
        .then(response => response.json())
        .then(data => {
            // Loop through the data and create options
            data.forEach(member => {
                const option = document.createElement('option');
                option.value = member.mess_id; // Use member ID or unique identifier
                option.text = member.email; // Display member name
                select.appendChild(option);
            });
        });
}

// Event listener to handle select change
const select = document.getElementById('member-select');
select.addEventListener('change', function () {
    const selectedOption = select.options[select.selectedIndex];
    const selectedImageSrc = "\assets\images\Alex Gonley.jpg";
    const selectedImage = document.querySelector('.selected-option img');
    selectedImage.src = selectedImageSrc;
});

// Populate the select dropdown initially
populateSelect();



function handleNameSelection(selectedValue) {
 
}
  
function handleMonthSelection(selectedValue) {
    alert('Selected: ' + selectedValue);
}