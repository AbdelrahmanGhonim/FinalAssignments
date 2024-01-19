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
    
    // Select the parent element where you want to display the articles
      const parentElement = document.querySelector('.fa-blog-list');
      
        // Loop through each article
        articles.forEach((article) => {
        // Create a new list item
        const li = document.createElement('li');

        // Create elements for the image, title, content, and link
        const img = document.createElement('img');
        const h2 = document.createElement('h2');
        const p = document.createElement('p');
        const a = document.createElement('a');

        // Set the attributes and content of the elements
        img.src = article.imageUrl;
        img.alt = article.title;
            img.className = 'fa-blog-list__img';
            
        h2.textContent = article.title;
            h2.className = 'fa-blog-list__heading';
            
        p.textContent = article.content;
            p.className = 'fa-blog-list__text';
            
        a.href = `/${article.title}`;
        a.textContent = 'Learn more';
        a.className = 'fa-blog-list__link';

        // Append the elements to the list item
        li.appendChild(img);
        li.appendChild(h2);
        li.appendChild(p);
        li.appendChild(a);

        // Append the list item to the parent element
        parentElement.appendChild(li);
    });

    // Loop through each blog content element and update the text
    // blogContents.forEach((blogContent, index) => {
    //     if (articles[index] && articles[index].content) {
    //         blogContent.textContent = articles[index].content;
    //     }

    //     // Add the title and the image as you did with the content
    //     if (articles[index] && articles[index].title) {
    //         blogTitles[index].textContent = articles[index].title;
    //     }

    //     if (articles[index] && articles[index].imageName) {
    //         // Update the src attribute to set the image source
    //         blogImages[index].src = "img/blog/" + articles[index].imageName;
    //     }
    // });
  }
  
  loadData();
