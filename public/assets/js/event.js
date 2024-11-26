// Product or Properties
// image preview on product update
function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        imagePreview.src = '';
        imagePreview.style.display = 'none';
    }
}

// inventory

let selectedPrice = 0; // Initialize the selected price variable

function updatePrice(selectElement) {
    // Get the selected option
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    
    // Retrieve the price using the 'data-price' attribute
    selectedPrice = parseFloat(selectedOption.getAttribute('data-price'));
    
    // Set the price to the input field with ID "Price"
    document.getElementById('Price').value = selectedPrice;

    // Reset the change field whenever the price is updated
    document.getElementById('change').value = '';

    // Hide error message and enable the submit button
    document.getElementById('amount-error').style.display = 'none';
    document.getElementById('submit-button').disabled = false;

    console.log('Selected price:', selectedPrice);
}

function calculateChange() {
    // Get the amount entered by the user
    var amount = parseFloat(document.getElementById('amount').value);

    if (!isNaN(amount) && amount >= selectedPrice) {
        // Calculate the change if the amount is greater than or equal to the price
        var change = amount - selectedPrice;

        // Display the change in the "change" field
        document.getElementById('change').value = change;

        // Hide the error message and enable the submit button
        document.getElementById('amount-error').style.display = 'none';
        document.getElementById('submit-button').disabled = false;
    } else {
        // If the amount is less than the price, clear the change field and show error message
        document.getElementById('change').value = '';

        // Show error message and disable the submit button
        document.getElementById('amount-error').style.display = 'block';
        document.getElementById('submit-button').disabled = true;
    }
}
