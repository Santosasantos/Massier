
let totalAmount = document.getElementById("total-amount");
let userAmount = document.getElementById("user-amount");
const checkAmountButton = document.getElementById("check-amount");
const totalAmountButton = document.getElementById("total-amount-button");
const productTitle = document.getElementById("product-title");
const errorMessage = document.getElementById("budget-error");
const productTitleError = document.getElementById("product-title-error");
const productCostError = document.getElementById("product-cost-error");
const amount = document.getElementById("amount");
const expenditureValue = document.getElementById("expenditure-value");
const balanceValue = document.getElementById("balance-amount");
const list = document.getElementById("list");
const submitExpenseButton = document.getElementById("submit-expense");

let tempAmount = 0;
// console.log(list.childElementCount);
// function toggleSubmitButton() {
//   if (list.childElementCount > 0) {
//     submitExpenseButton.style.display = "block";
//   } else {
//     submitExpenseButton.style.display = "none";
//   }
// }

// toggleSubmitButton();

totalAmountButton.addEventListener("click", () => {
  tempAmount = totalAmount.value;
  if (tempAmount === "" || tempAmount < 0) {
    errorMessage.classList.remove("hide");
  } else {
    errorMessage.classList.add("hide");
    amount.innerHTML = tempAmount;
    balanceValue.innerText = tempAmount - expenditureValue.innerText;
    totalAmount.value = "";
  }
});

const disableButtons = (bool) => {
  let editButtons = document.getElementsByClassName("edit");
  Array.from(editButtons).forEach((element) => {
    element.disabled = bool;
  });
};

const modifyElement = (element, edit = false) => {
  let parentDiv = element.parentElement;
  let currentBalance = balanceValue.innerText;
  let currentExpense = expenditureValue.innerText;
  let parentAmount = parentDiv.querySelector(".amount").innerText;
  if (edit) {
    let parentText = parentDiv.querySelector(".product").innerText;
    productTitle.value = parentText;
    userAmount.value = parentAmount;
    disableButtons(true);
  }
  balanceValue.innerText = parseInt(currentBalance) + parseInt(parentAmount);
  expenditureValue.innerText =
    parseInt(currentExpense) - parseInt(parentAmount);
  parentDiv.remove();
  // toggleSubmitButton();
};

const listCreator = (expenseName, expenseValue) => {
  let sublistContent = document.createElement("div");
  sublistContent.classList.add("sublist-content", "flex-space");
  list.appendChild(sublistContent);
  sublistContent.innerHTML = `<input name="item[]" readonly class="product" style="border: none;" value="${expenseName}"><input readonly style="border: none;" name="price[]" class="amount" value="${expenseValue}">`;
  let editButton = document.createElement("button");
  editButton.classList.add("fa-solid", "fa-pen-to-square", "edit");
  editButton.style.fontSize = "1.2em";
  editButton.addEventListener("click", () => {
    modifyElement(editButton, true);
  });
  let deleteButton = document.createElement("button");
  deleteButton.classList.add("fa-solid", "fa-trash-can", "delete");
  deleteButton.style.fontSize = "1.2em";
  deleteButton.addEventListener("click", () => {
    modifyElement(deleteButton);
  });
  sublistContent.appendChild(editButton);
  sublistContent.appendChild(deleteButton);
  document.getElementById("list").appendChild(sublistContent);
  // toggleSubmitButton();
};

checkAmountButton.addEventListener("click", () => {
  if (!userAmount.value || !productTitle.value) {
    productTitleError.classList.remove("hide");
    return false;
  }
  disableButtons(false);
  let expenditure = parseInt(userAmount.value);
  let sum = parseInt(expenditureValue.innerText) + expenditure;
  expenditureValue.innerText = sum;
  const totalBalance = tempAmount - sum;
  balanceValue.innerText = totalBalance;
  listCreator(productTitle.value, userAmount.value);
  productTitle.value = "";
  userAmount.value = "";
});

// ... Your existing JavaScript code ...

submitExpenseButton.addEventListener("click", () => {
  // Get the expense data
  const expenseTitle = productTitle.value;
  const expenseCost = userAmount.value;

  // Assuming you have stored the mess_id in a variable or session
  const messId =1;

  // Create an object to store the data
  const expenseData = {
      product_title: expenseTitle,
      product_cost: expenseCost,
      mess_id: messId
  };

  // Send an AJAX request to insert the expense data
  $.ajax({
    type: 'POST',
    url: 'insert_expense.php',
      body: JSON.stringify(expenseData),
      headers: {
          'Content-Type': 'application/json'
      }
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          alert('Expense submitted successfully');
          // Clear the list
          list.innerHTML = '';
          // Reset balances
          expenditureValue.innerText = '0';
          balanceValue.innerText = amount.innerText;
      } else {
          alert('Expense submission failed');
      }
  })
  .catch(error => {
      console.error('Error:', error);
  });
});

