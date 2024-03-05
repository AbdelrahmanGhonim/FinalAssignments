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

/////////////////////////update user info//////////////////////////////

document.addEventListener('DOMContentLoaded', function () {
    const signupForm = document.getElementById('signup-form');
    
    signupForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(signupForm);
        const formDataObject = {};
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });

        const isUpdate = (signupForm.querySelector('#button').textContent === 'Update');
        const apiEndpoint = isUpdate ? 'http://localhost/api/user/update' : 'http://localhost/signup/create';

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
            return response.text();
        })
        .then(data => {
            console.log('Raw Response:', data);

            try {
                const parsedData = JSON.parse(data);

                if (isUpdate) {
                    // Display a message to the user that the update was successful
                    //popup message
                    alert("Your account has been updated");
                    loadData();
                }
            } catch (error) {
                console.log('User data not reloaded.');
                console.error('JSON Parsing Error:', error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
      
    });
});



/////////////////////////delete user info//////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
    const deleteButton = document.getElementById('delete-button');

    deleteButton.addEventListener('click', function () {
        const confirmed = confirm('Are you sure you want to delete your account?');
        if (confirmed) {
            // Function to get form data
            function getFormData() {
                const signupForm = document.getElementById('signup-form');
                const formData = new FormData(signupForm);
                const formDataObject = {};
                formData.forEach((value, key) => {
                    formDataObject[key] = value;
                });
                return formDataObject;
            }

            const formDataObject = getFormData();

            fetch('http://localhost/api/user/delete', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formDataObject),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                // Reset the signup form
                const signupForm = document.getElementById('signup-form');
                signupForm.reset();
                alert("Your account has been deleted");
                //can you redirect to home page
                window.location.href = "http://localhost/login";
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});






