
    
        const today = new Date().toISOString().split('T')[0];

        document.getElementById('dateInput').value = new Date(today).toDateInputValue();

const addButton = document.querySelector('.add-button');
addButton.addEventListener('click', addMealEntry);
const addButton1 = document.querySelector('.add-button1');
addButton1.addEventListener('click', addMealEntry);

function addMealEntry() {
    const mealEntry = document.querySelector('.meal-entry');
    const newMealEntry = mealEntry.cloneNode(true);

   
    const clonedButton = newMealEntry.querySelector('.add-button');
    clonedButton.removeEventListener('click', addMealEntry);

    mealEntry.parentNode.appendChild(newMealEntry);

    const newAddButton = newMealEntry.querySelector('.add-button');
    newAddButton.addEventListener('click', addMealEntry);

}


function removeMealEntry(button) {
    const mealEntries = document.querySelectorAll('.meal-entry');
    
    if (mealEntries.length <= 2) {
        alert('You cannot remove the last two meal entries.');
        return;
    }

    const mealEntry = button.parentElement;
    mealEntry.remove();
    checkAndDisplayMessage();
}

