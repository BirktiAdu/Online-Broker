document.getElementById('add-car-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('seller.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
      .then(data => {
          // Handle response
          alert('Car listed successfully!');
          // Reset form or redirect
      }).catch(error => {
          // Handle error
          console.error('Error:', error);
      });
});