function loadData() {
    fetch("http://localhost/api/blog")
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
  
  
  function displayContent(articles) {
    // Select all the blog content elements
    const blogContents = document.querySelectorAll('.blog-content');
    const blogImages = document.querySelectorAll('.blog-image');
    const blogTitles = document.querySelectorAll('.blog-header');
    //can you set the blog title with the orange color?


    // Loop through each blog content element and update the text
    blogContents.forEach((blogContent, index) => {
        if (articles[index] && articles[index].content) {
            blogContent.textContent = articles[index].content;
        }

        // Add the title and the image as you did with the content
        if (articles[index] && articles[index].title) {
            blogTitles[index].textContent = articles[index].title;
           // blogTitles[index].style.color = 'orange';

        }

        if (articles[index] && articles[index].imageName) {
            // Update the src attribute to set the image source
            blogImages[index].src = "img/blog/" + articles[index].imageName;
        }
    });
  }
  
  loadData();
