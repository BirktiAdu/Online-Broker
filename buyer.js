document.addEventListener('DOMContentLoaded', function () {
    fetch('fetch_cars.php')
        .then(response => response.json())
        .then(cars => {
            const carListElement = document.getElementById('car-list');
            cars.forEach(car => {
                const carElement = document.createElement('div');
                carElement.innerHTML = `
                    <h3>${car.make} ${car.model}</h3>
                    <p>Year: ${car.year}</p>
                    <p>Price: ${car.price}</p>
                    <p>Description: ${car.description}</p>
                    <img src="${car.image}" alt="${car.make} ${car.model}">
                `;
                carListElement.appendChild(carElement);
            });
        }).catch(error => {
            console.error('Error:', error);
        });
});