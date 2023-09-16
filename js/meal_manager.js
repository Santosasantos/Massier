
  document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll("tr"); // Select all table rows

    rows.forEach(row => {
      const inputFields = row.querySelectorAll(".inp"); // Select input fields with class "inp" in each row

      inputFields.forEach(input => {
        input.addEventListener("input", () => updateRowTotal(row));
      });
    });
  });

  function updateRowTotal(row) {
    const inputFields = row.querySelectorAll(".inp"); // Select input fields with class "inp" in the row
    let rowTotal = 0;

    inputFields.forEach(input => {
      if (input.value !== "") {
        rowTotal += parseFloat(input.value);
      }
    });

    row.querySelector(".total").textContent = rowTotal.toFixed(2);
  }

