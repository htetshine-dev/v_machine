import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$('.btn-delete').on('click', function() {
    var itemId = $(this).data('id');
    var itemName = $(this).data('name')
    
    // Display confirmation box
    if (confirm("Are you sure you want to delete "+ itemName +"?")) {
        // If confirmed, submit the form
        $('#delete-form-' + itemId).submit();
    }
});
