function loadData() {
  fetch("http://localhost/api/user")
      .then(response => response.json())
      .then(data => {
          console.log('API Response:', data);

          if (data) {            
              displayUserInfo(data);
          } else {
              console.error('Error: Items not found in API response.');
          }
      })
      .catch(error => {
          console.error('Error fetching items:', error);
      });
}


function displayUserInfo(user) {

  const userIdElement = document.getElementById('user-id'); // Hidden input for user ID
  const usernameElement = document.getElementById('username');
  const passwordElement = document.getElementById('password');
  const ageElement = document.getElementById('age');
  const genderElement = document.getElementById('gender');
  const weightElement = document.getElementById('weight');
  const heightElement = document.getElementById('height');
  const goalElement = document.getElementById('goal');
  const signupButton = document.getElementById('button');

  // Check if the user object is not empty
  if (user) {
      // Fill in the HTML elements with user data
      userIdElement.value = user.id || ''; // Set the value of the hidden input for user ID
      usernameElement.value = user.userName || '';
      passwordElement.value = user.password || '';
      ageElement.value = user.age || '';
      genderElement.value = user.gender || '';
      weightElement.value = user.weight || '';
      heightElement.value = user.height || '';
      goalElement.value = user.goal || '';
      

//check the session if it is empty or not;

      if (user.userName!=null) {// it works but later check for more good option
        signupButton.textContent = 'Update';
      } else {
        signupButton.textContent = 'Submit';
      }
  } else {
      console.error('Error: Empty user object received.');
  }
}

loadData();


document.addEventListener('DOMContentLoaded', function () {
  const signupForm = document.getElementById('signup-form');

  signupForm.addEventListener('submit', function (event) {
      event.preventDefault(); // Prevent the default form submission

      // Collect form data
      const formData = new FormData(signupForm);
      const formDataObject = {};
      formData.forEach((value, key) => {
          formDataObject[key] = value;
      });

      // Determine whether it's a signup or update request
      // remove the code which is not needed ToDO later
      const isUpdate = (signupForm.querySelector('#button').textContent === 'Update');
      const apiEndpoint = isUpdate ? 'http://localhost/api/user/update' : 'http://localhost/signup/create';

      // Make an AJAX request to the API
      fetch(apiEndpoint, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify(formDataObject),
      })
      .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); // Read the raw text content
    })
    .then(data => {
        console.log('Raw Response:', data); // Log the raw response
    
        // Parse the response as JSON
        try {
            const parsedData = JSON.parse(data);
           
            if (isUpdate) {
                // can you display a message to the user that the update was successful like a toast pop up message
                

                loadData();
                                
            }
        } catch (error) {
          console.log('User data not reloaded.');

            console.error('JSON Parsing Error:', error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle errors, e.g., show an error message to the user
    });

  });
});







