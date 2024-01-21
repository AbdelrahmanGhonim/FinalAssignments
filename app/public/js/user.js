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

// Add an event listener for the delete button
// const deleteButton = document.getElementById('delete-button');
// deleteButton.addEventListener('click', function () {
   
//     const confirmed = confirm('Are you sure you want to delete your account?');
//     if (confirmed) {
//         console.log('User confirmed the deletion.');
       

//         fetch('http://localhost/api/user/delete', {
//             method: 'DELETE',
//             headers: {
//                 'Content-Type': 'application/json',
//             },
//             // Set an empty body for DELETE requests
//             body: JSON.stringify({}),
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.text(); // Read the raw text content
//         })
//         .then(data => {
//             console.log('Raw Response:', data); // Log the raw response

//             // Parse the response as JSON
//             try {
//                 const parsedData = JSON.parse(data);
//                 console.log('Parsed Response:', parsedData);

//                 // Display a message to the user that the account was deleted (e.g., toast pop-up)
//                 //popup message
//                 alert("Your account has been deleted");
//                 // You can also handle page redirection or any other action after deletion
//             } catch (error) {
//                 console.error('JSON Parsing Error:', error);
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             // Handle errors, e.g., show an error message to the user
//         });
//     }
// });

// deleteButton.addEventListener('click', function () {
//     const confirmed = confirm('Are you sure you want to delete your account?');
//     if (confirmed) {
//         console.log('User confirmed the deletion.');

//         const formDataObject = getFormData();

//         fetch('http://localhost/api/user/delete', {
//             method: 'DELETE',
//             headers: {
//                 'Content-Type': 'application/json',
//             },
//             body: JSON.stringify(formDataObject),
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.text();
//         })
//         .then(data => {
//             console.log('Raw Response:', data);

//             try {
//                 const parsedData = JSON.parse(data);
//                 console.log('Parsed Response:', parsedData);

//                 alert("Your account has been deleted");
//             } catch (error) {
//                 console.error('JSON Parsing Error:', error);
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//         });
//     }
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const deleteButton = document.getElementById('delete-button');

//     deleteButton.addEventListener('click', function () {
//         const confirmed = confirm('Are you sure you want to delete your account?');
//         if (confirmed) {
//             // Function to get form data
//             function getFormData() {
//                 const signupForm = document.getElementById('signup-form');
//                 const formData = new FormData(signupForm);
//                 const formDataObject = {};
//                 formData.forEach((value, key) => {
//                     formDataObject[key] = value;
//                 });
//                 return formDataObject;
//             }

//             const formDataObject = getFormData();

//             fetch('http://localhost/api/user/delete', {
//                 method: 'DELETE',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//                 body: JSON.stringify(formDataObject),
//             })
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error('Network response was not ok');
//                 }
//                 return response.text();
//             })
//             .then(data => {
//                 console.log('Raw Response:', data);

//                 try {
//                     const parsedData = JSON.parse(data);
//                     console.log('Parsed Response:', parsedData);

//                     alert("Your account has been deleted");
//                 } catch (error) {
//                     console.error('JSON Parsing Error:', error);
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//             });
//         }
//     });
// });
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
                // Check if data is not empty before parsing
                // Call the displaySuccessMessage function

           //     TODO:
                displaySuccessMessage();

                // Reset the signup form
                const signupForm = document.getElementById('signup-form');
                signupForm.reset();

                alert("Your account has been deleted");
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
 // Function to display a success message on the page
 function displaySuccessMessage() {
    // Create a new div element
    const successMessage = document.createElement('div');
    successMessage.textContent = 'User deleted successfully!';
    successMessage.style.backgroundColor = '#4CAF50'; // Green background color
    successMessage.style.color = 'white';
    successMessage.style.padding = '10px';
    successMessage.style.marginTop = '10px';

    // Append the div element to the body (you can choose a different container)
    document.body.appendChild(successMessage);
}


});






