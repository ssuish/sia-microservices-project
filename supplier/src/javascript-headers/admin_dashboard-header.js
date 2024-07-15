
var modal = document.getElementById('modal');
modal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var productID = button.getAttribute('data-id');
    var name = button.getAttribute('data-name');
    var type = button.getAttribute('data-type');
    var price = button.getAttribute('data-price');
    var size = button.getAttribute('data-size');
    var color = button.getAttribute('data-color');
    var thickness = button.getAttribute('data-thickness');
    var warranty = button.getAttribute('data-warranty');
    var thumbnail = button.getAttribute('data-thumbnail');
    var currency = button.getAttribute('data-currency');
    var quantity = button.getAttribute('data-quantity');
    
    var modalTitle = modal.querySelector('.modal-title');
    var productIDInput = modal.querySelector('#productID');
    var nameInput = modal.querySelector('#name');
    var typeInput = modal.querySelector('#type');
    var priceInput = modal.querySelector('#price');
    var sizeInput = modal.querySelector('#size');
    var colorInput = modal.querySelector('#color');
    var thicknessInput = modal.querySelector('#thickness');
    var warrantyInput = modal.querySelector('#warranty');
    var thumbnailInput = modal.querySelector('#thumbnail');
    var currencyInput = modal.querySelector('#currency');
    var quantityInput = modal.querySelector('#quantity');
    var existingThumbnailInput = modal.querySelector('#existingThumbnail');

    if (productID) {
        modalTitle.textContent = 'Update Product';
        productIDInput.value = productID;
        nameInput.value = name;
        typeInput.value = type;
        priceInput.value = price;
        sizeInput.value = size;
        colorInput.value = color;
        thicknessInput.value = thickness;
        warrantyInput.value = warranty;
        existingThumbnailInput.value = thumbnail;
        currencyInput.value = currency;
        quantityInput.value = quantity;
    }
});

document.addEventListener('DOMContentLoaded', function() {
var form = document.querySelector('#addProductModal form');
form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(form);
    
    fetch('includes/add_product.inc.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
      .then(data => {
          console.log(data); // Log the response from the server
          if (data.includes('success')) {
              alert('Product added successfully!');
              $('#addProductModal').modal('hide');
              location.reload(); // Reload the page or update UI as needed
          } else {
              alert('Error adding product');
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
});
});


    // Modal handling script
    var modal = document.getElementById('modal');
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var productID = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var type = button.getAttribute('data-type');
        var price = button.getAttribute('data-price');
        var size = button.getAttribute('data-size');
        var color = button.getAttribute('data-color');
        var thickness = button.getAttribute('data-thickness');
        var warranty = button.getAttribute('data-warranty');
        var thumbnail = button.getAttribute('data-thumbnail');
        var currency = button.getAttribute('data-currency');
        var quantity = button.getAttribute('data-quantity');
        
        var modalTitle = modal.querySelector('.modal-title');
        var productIDInput = modal.querySelector('#productID');
        var nameInput = modal.querySelector('#name');
        var typeInput = modal.querySelector('#type');
        var priceInput = modal.querySelector('#price');
        var sizeInput = modal.querySelector('#size');
        var colorInput = modal.querySelector('#color');
        var thicknessInput = modal.querySelector('#thickness');
        var warrantyInput = modal.querySelector('#warranty');
        var existingThumbnailInput = modal.querySelector('#existingThumbnail');
        var currencyInput = modal.querySelector('#currency');
        var quantityInput = modal.querySelector('#quantity');

        if (productID) {
            modalTitle.textContent = 'Update Product';
            productIDInput.value = productID;
            nameInput.value = name;
            typeInput.value = type;
            priceInput.value = price;
            sizeInput.value = size;
            colorInput.value = color;
            thicknessInput.value = thickness;
            warrantyInput.value = warranty;
            existingThumbnailInput.value = thumbnail;
            currencyInput.value = currency;
            quantityInput.value = quantity;
        }
    });

    // Floating messages
    document.querySelector('.btn-download').addEventListener('click', function() {
        document.getElementById('downloadPrompt').classList.add('show');
    });

    document.getElementById('confirmDownload').addEventListener('click', function() {
        // Trigger download and show success message
        document.getElementById('downloadPrompt').classList.remove('show');
        document.getElementById('successMessage').classList.add('show');
    });

    document.getElementById('cancelDownload').addEventListener('click', function() {
        document.getElementById('downloadPrompt').classList.remove('show');
    });

    // Form submission via fetch API
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('#addProductModal form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(form);
            
            fetch('includes/add_product.inc.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                // Handle success, e.g., show a success message or update the table
                console.log(result);
            })
            .catch(error => {
                // Handle error
                console.error('Error:', error);
            });
        });
    });



    function confirmDelete(productID) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = 'includes/delete_product.inc.php?productID=' + productID;
        }
    }


    