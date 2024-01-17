<?php
namespace App\Controllers;

use App\Services\BlogService;
class BlogController
{
    private $blogService;

    // initialize services
    function __construct()
    {
        $this->blogService = new BlogService();
    }
    
    public function index()
    {
            try {
                header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
                header("Access-Control-Allow-Headers: Content-Type");
                header("Access-Control-Allow-Methods: GET, OPTIONS");
                header("Content-Type: application/json");
        
                // Fetch data from the service  
                $articles = $this->blogService->getAll();
    
                // Encode and echo the entire response
                echo json_encode($articles);
               // echo json_encode(['workout' => $workout]);
        
            } catch (\Exception $e) {
                echo json_encode(['error' => 'An error occurred while fetching articles.']);
            }

    }
    

}
