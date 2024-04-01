// can you implement the get request to the api here?
function loadData() {
  fetch("http://localhost/api/nutritionFact")
    .then((response) => response.json())
    .then((data) => {
      console.log("API Response:", data);

      if (data.length > 0) {
        // Display items (articles and workouts) if the response array is not empty
        displayContent(data);
      } else {
        console.error("Error: Items not found in API response.");
      }
    })
    .catch((error) => {
      console.error("Error fetching items:", error);
    });
}

function displayContent(data) {
  const table = document.getElementById("nutritionTable");
  const thead = table.querySelector("thead tr");
  const tbody = table.querySelector("tbody");

  // Clear existing table content
  thead.innerHTML = "";
  tbody.innerHTML = "";

  // Create table header
  const headersToExclude = ["food_id", "goal_id"];
  Object.keys(data[0]).forEach((key) => {
    if (!headersToExclude.includes(key)) {
      const th = document.createElement("th");
      th.textContent = key;
      thead.appendChild(th);
    }
  });

  function displayContent(data) {
    const table = document.getElementById("nutritionTable");
    const thead = table.querySelector("thead tr");
    const tbody = table.querySelector("tbody");

    // Clear existing table content
    thead.innerHTML = "";
    tbody.innerHTML = "";

    // Create table header
    const headersToExclude = ["food_id", "goal_id"];
    Object.keys(data[0]).forEach((key) => {
      if (!headersToExclude.includes(key)) {
        const th = document.createElement("th");
        th.textContent = key;
        thead.appendChild(th);
      }
    });

    // Create table body
    data.forEach((item) => {
      const row = document.createElement("tr");
      Object.keys(item).forEach((key) => {
        if (!headersToExclude.includes(key)) {
          const td = document.createElement("td");
          td.textContent = item[key];
          row.appendChild(td);
        }
      });
      tbody.appendChild(row);
    });
  }

  // Create table body
  data.forEach((item) => {
    const row = document.createElement("tr");
    Object.keys(item).forEach((key) => {
      if (!headersToExclude.includes(key)) {
        const td = document.createElement("td");
        td.textContent = item[key];
        row.appendChild(td);
      }
    });
    tbody.appendChild(row);
  });
}

// Open popup form when "Add Workout" button is clicked
document.getElementById("addWorkoutBtn").addEventListener("click", function () {
  document.getElementById("popupForm").style.display = "block";
});

// Close popup form when close button is clicked
function closePopupForm() {
  document.getElementById("popupForm").style.display = "none";
  // Listen for the end of the transition
  popupForm.addEventListener("transitionend", function handler() {
    // Remove the event listener to avoid memory leaks
    popupForm.removeEventListener("transitionend", handler);

    // After the transition has ended, load the workouts
    loadWorkout();
  });
}

document.getElementById("adding-btn").addEventListener("click", function () {
  const exerciseName = document.getElementById("exerciseName").value;
  const duration = document.getElementById("duration").value;

  if (!exerciseName || !duration) {
    alert("Please fill in all fields.");
    return;
  }
  closePopupForm();
});

////////////////////////Fetch workout data from the API////////////////////////

function loadWorkout() {
  // Return the fetch promise directly
  return fetch("http://localhost/api/workout")
    .then((response) => response.json())
    .then((data) => {
      console.log("API Response:", data);

      if (data.length > 0) {
        displayWorkouts(data);
      }
    })
    .catch((error) => {
      console.error("Error fetching items:", error);
    });
}

// Function to display workouts
function displayWorkouts(workouts) {
  // Clear previous workout list
  const workoutList = document.getElementById("addedWorkouts");
  workoutList.innerHTML = "";

  // Populate the workout list with retrieved data
  workouts.forEach((workout) => {
    const li = document.createElement("li");
    li.textContent = `${workout.workoutName} / ${workout.duration} min`;

    const checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.style.marginLeft = "5px";
    checkbox.style.transform = "scale(1.5)";

    checkbox.addEventListener("change", function () {
      if (checkbox.checked) {
        fetch("http://localhost/api/workout/deleteWorkout", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            userId: workout.userId,
            workoutName: workout.workoutName,
            duration: workout.duration,
          }),
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error("Network response was not ok");
            }
            alert("Workout completed!");
            // removeWorkoutFromUI(li);
            loadWorkout();
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      }
    });
    li.appendChild(checkbox);
    workoutList.appendChild(li);
  });
}
function removeWorkoutFromUI(li) {
  const workoutList = document.getElementById("addedWorkouts");
  workoutList.removeChild(li);
}

//////////////////////////Add workout to the list////////////////////////
function getWorkoutFormData() {
  const userId = document.getElementById("userIdLabel").textContent;
  const workoutName = document.getElementById("exerciseName").value;
  const duration = document.getElementById("duration").value;

  // Check if all fields are filled
  if (!userId || !workoutName || !duration) {
    return null;
  }

  // Check if duration is an integer
  if (!Number.isInteger(Number(duration))) {
    alert("Duration must be an integer.");
    return null;
  }
  return { userId, workoutName, duration };
}

document.addEventListener("DOMContentLoaded", function () {
  const workoutForm = document.getElementById("workoutForm");
  const addingBtn = document.getElementById("adding-btn");

  addingBtn.addEventListener("click", function (event) {
    event.preventDefault();

    const workoutData = getWorkoutFormData();

    const apiEndpoint = "http://localhost/api/workout/addWorkout";

    fetch(apiEndpoint, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(workoutData),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        //alert("Workout added successfully!")
        loadWorkout();
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});

///////////////////////EDAMAM API////////////////////////

document.getElementById("searchButton").addEventListener("click", function () {
  const foodName = document.getElementById("searchInput").value.trim();
  if (foodName !== "") {
    // Call a function to fetch and display nutritional information
    fetchNutritionInfo(foodName);
  } else {
    alert("Please enter a food name.");
  }
});

function fetchNutritionInfo(foodName) {
  const APP_ID = "2192294e";
  const APP_KEY = "5207d82f06e1c1806dd0250adf649c32";
  const apiUrl = `https://api.edamam.com/api/recipes/v2?type=public&q=${foodName}&app_id=${APP_ID}&app_key=${APP_KEY}`;

  fetch(apiUrl)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      // Display the nutritional information
      displayNutritionInfo(data);
    })
    .catch((error) => {
      console.error("Error fetching nutritional information:", error);
    });
}

function displayNutritionInfo(data) {
  const recipeList = document.getElementById("recipeList");
  recipeList.innerHTML = ""; // Clear previous content

  data.hits.forEach((hit) => {
    const recipe = hit.recipe;
    const li = document.createElement("li");

    // Create icon element
    const icon = document.createElement("i");
    icon.classList.add("fa", "fa-plus"); 
    icon.style.cursor = "pointer"; 
    icon.style.backgroundColor = "orange";  
    icon.style.padding = "5px";
    icon.style.borderRadius = "50%";
    icon.style.marginLeft = "10px"; 
    icon.onclick = () => addFood(recipe); // Set onclick function to add food

    // Add recipe information
    li.innerHTML += ` ${
      recipe.label
    }, Carbs: ${recipe.totalNutrients.CHOCDF.quantity.toFixed(2)}g, 
        Proteins: ${recipe.totalNutrients.PROCNT.quantity.toFixed(
          2
        )}g, Fats: ${recipe.totalNutrients.FAT.quantity.toFixed(2)}g, 
        Fibers: ${recipe.totalNutrients.FIBTG.quantity.toFixed(2)}g`;
    li.appendChild(icon); // Append icon to list item

    recipeList.appendChild(li);
  });
}
document
  .getElementById("openPopupButtonf")
  .addEventListener("click", function () {
    document.getElementById("searchPopupf").style.display = "block";
  });

document.querySelector(".closef").addEventListener("click", function () {
  document.getElementById("searchPopupf").style.display = "none";
});

///////////////////////Fetching the User food choice//////////////////////////

function loadUserFood() {
  // This function already returns a promise due to the fetch call
  return fetch("http://localhost/api/nutritionFact/getUserFood")
    .then((response) => response.json())
    .then((data) => {
      console.log("API Response:", data);

      if (data.length > 0) {
        displayUserFood(data);
      }
    })
    .catch((error) => {
      console.error("Error fetching items:", error);
    });
}

function displayUserFood(data) {
  const tbody = document
    .getElementById("nutritionTable")
    .querySelector("tbody");
    const editButton = document.getElementById("editButton"); // Make sure to get a reference to the edit button


  // Enable or disable the edit button based on whether there is user food in the table
  if (data.length > 0) {
    editButton.disabled = false;
    editButton.style.backgroundColor = "";
    editButton.style.opacity = ""; // TODO: Add your styles here
  } else {
    editButton.disabled = true;
    editButton.style.backgroundColor = "gray";
    editButton.style.opacity = "0.1";
  }
  // Directly append new data to the table body without clearing it
  data.forEach((item) => {
    const row = document.createElement("tr");
    Object.keys(item).forEach((key) => {
      // Exclude any headers you don't want to display in the table
      const headersToExclude = ["food_id", "goal_id", "id"];
      if (!headersToExclude.includes(key)) {
        const td = document.createElement("td");
        td.textContent = item[key];
        row.appendChild(td);
      }
    });
    const deleteButton = document.createElement("button");
    deleteButton.className = "btn  delete-button";
    deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
    deleteButton.style.display = "none"; // Hide the delete button initially
    deleteButton.style.backgroundColor = "red"; // Make the button background red

    deleteButton.addEventListener("click", function () {
      // Send delete request
      const foodId = item.id; // Assuming each item has a 'food_id' property
      // console.log(item);
      // console.log(userId);
      fetch(`http://localhost/api/nutritionFact/deleteUserFood`, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ foodId }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          // Remove row from table
          row.remove();
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });

    // Add a new cell to the row for the delete button
    const deleteCell = document.createElement("td");
    deleteCell.appendChild(deleteButton);
    row.appendChild(deleteCell);

    tbody.appendChild(row);
  });
}

document.getElementById("editButton").addEventListener("click", function () {
  const deleteButtons = document.querySelectorAll(".delete-button");
  for (let i = 0; i < deleteButtons.length; i++) {
    if (
      deleteButtons[i].style.display === "none" ||
      deleteButtons[i].style.display === ""
    ) {
      deleteButtons[i].style.display = "inline-block";
    } else {
      deleteButtons[i].style.display = "none";
    }
  }
});
///////////////////////ADD FOOD TO THE DATABASE////////////////////////
function addFood(recipe) {
  const apiUrl = "http://localhost/api/nutritionFact/addFood"; // Update with your API endpoint
  const userId = document.getElementById("userIdLabel").textContent;

  // Extract details from the recipe
  const foodDetails = {
    userId: userId,
    foodname: recipe.label,
    carbs: recipe.totalNutrients.CHOCDF.quantity.toFixed(2),
    proteins: recipe.totalNutrients.PROCNT.quantity.toFixed(2),
    fats: recipe.totalNutrients.FAT.quantity.toFixed(2),
    fibers: recipe.totalNutrients.FIBTG.quantity.toFixed(2),
  };

  // Define the POST request options
  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(foodDetails),
  };

  // Send the POST request
  fetch(apiUrl, options)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      alert("Food added successfully!");
      console.log("Food added successfully:", data);
      initializeDataLoad();
    })
    .catch((error) => {
      console.error("Error adding food:", error);
    });
}

// Add an edit button to your HTML

// let deleteMode = false;

// editButton.addEventListener('click', function() {
//   deleteMode = !deleteMode; // Toggle delete mode

//   // Get all rows in the table
//   const rows = document.querySelectorAll('#nutritionTable tbody tr');

//   rows.forEach(row => {
//     // If in delete mode, add delete button, otherwise remove it
//     if (deleteMode) {
//       const deleteButton = document.createElement('button');
//       deleteButton.textContent = 'Delete';
//       deleteButton.addEventListener('click', function() {
//         // Send delete request
//         const foodId = row.getAttribute('data-food-id'); // Assuming each row has a 'data-food-id' attribute

//         fetch(`http://localhost/api/nutritionFact/deleteUserFood`, {
//           method: 'DELETE',
//         })
//         .then(response => {
//           if (!response.ok) {
//             throw new Error('Network response was not ok');
//           }
//           // Remove row from table
//           row.remove();
//         })
//         .catch(error => {
//           console.error('Error:', error);
//         });
//       });

//       row.appendChild(deleteButton);
//     } else {
//       const deleteButton = row.querySelector('button');
//       if (deleteButton) {
//         row.removeChild(deleteButton);
//       }
//     }
//   });
// });

async function initializeDataLoad() {
  try {
    await loadData(); // Load initial data
    await loadWorkout(); // Then load workout data
    await loadUserFood(); // Finally, load user food data
  } catch (error) {
    console.error("Error during data initialization:", error);
  }
}

// Kick off the data loading process
initializeDataLoad();
