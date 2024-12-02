// Product or Properties
// image preview on product update
console.log("event.js loaded");
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

// 

function previewUpdateImage(event) {
    const imagePreview = document.getElementById('imageUpdatePreview');
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

// Inventory

// For Add Modal
let selectedPrice = 0;
function getPrice(selectElement) {
    // Get the selected option
    let selectedOption = selectElement.options[selectElement.selectedIndex];
    selectedPrice = parseFloat(selectedOption.getAttribute('data-price'));
    document.getElementById('Price').value = selectedPrice;
    document.getElementById('change').value = '';

    let image = selectedOption.getAttribute('data-image');
    document.getElementById('imagePreview').src = 'public/images/products/' + image;
    document.getElementById('imagePreview').style.display = 'block';
}
function calculateChange() {
    let amount = parseFloat(document.getElementById('amount').value);
    let change = amount - selectedPrice;
    document.getElementById('change').value = change.toFixed(2);   
}

// For Update Modal
price = 0;
function getPriceImage(e){
    // Get the selected option
    let selectedOption = e.options[e.selectedIndex];
    selectedUpdatePrice = parseFloat(selectedOption.getAttribute('data-price'));
    price = document.getElementById('updatePrice').value = selectedUpdatePrice;
    amount = document.getElementById('updateAmount').value;
    document.getElementById('updateChange').value = price - amount;

    let selectedUpdateImage = selectedOption.getAttribute('data-image');
    document.getElementById('imageUpdatePreview').src = 'public/images/products/' + selectedUpdateImage;
}

function calculateUpdateChange(){
    amount = document.getElementById('updateAmount').value;
    document.getElementById('updateChange').value = price - amount;
}