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
let selectedPrice = 0;
let selectedUpdatePrice = 0;

function updatePrice(selectElement) {
    // Get the selected option
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    selectedPrice = parseFloat(selectedOption.getAttribute('data-price'));
    document.getElementById('Price').value = selectedPrice;
    document.getElementById('change').value = '';
}

function calculateChange() {
    var amount = parseFloat(document.getElementById('amount').value);
    var change = amount - selectedPrice;
    document.getElementById('change').value = change.toFixed(2);
}

function updateInventoryPrice(selectElement) {
    var selectedUpdateOption = selectElement.options[selectElement.selectedIndex];
    selectedUpdatePrice = parseFloat(selectedUpdateOption.getAttribute('data-price'));
    document.getElementById('updatePrice').value = selectedUpdatePrice;
    document.getElementById('updateChange').value = '';
}

function calculateUpdateChange() {
    let amountUpdate = parseFloat(document.getElementById('updateAmount').value);
    let changeUpdate = amountUpdate - selectedUpdatePrice;
    document.getElementById('updateChange').value = changeUpdate.toFixed(2);
}