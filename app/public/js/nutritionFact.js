// can you implement the get request to the api here?
function loadData() {
  fetch("http://localhost/api/nutritionFact")
      .then(response => response.json())
      .then(data => {
          console.log('API Response:', data);

          if (data.length > 0) {
              // Display items (articles and workouts) if the response array is not empty
              displayContent(data);
          } else {
              console.error('Error: Items not found in API response.');
          }
      })
      .catch(error => {
          console.error('Error fetching items:', error);
      });
}

function displayContent(data) {
    const table = document.getElementById('nutritionTable');
    const thead = table.querySelector('thead tr');
    const tbody = table.querySelector('tbody');

    // Clear existing table content
    thead.innerHTML = '';
    tbody.innerHTML = '';

    // Create table header
    const headersToExclude = ['food_id', 'goal_id'];
    Object.keys(data[0]).forEach(key => {
        if (!headersToExclude.includes(key)) {
            const th = document.createElement('th');
            th.textContent = key;
            thead.appendChild(th);
        }
    });

    // Create table body
    data.forEach(item => {
        const row = document.createElement('tr');
        Object.keys(item).forEach(key => {
            if (!headersToExclude.includes(key)) {
                const td = document.createElement('td');
                td.textContent = item[key];
                row.appendChild(td);
            }
        });
        tbody.appendChild(row);
    });
}

    loadData();