<?php
namespace App\Controllers;
use App\Services\BlogService;

require __DIR__ . '/../services/blogservice.php';

class BlogController  {

    private $blogServices;

    function __construct(){
        $this->blogServices = new BlogService();
    }

    public function index() {
        include '../views/blog/blog.php';
      //  $articles = $this->blogServices->getAllArticles();
    }
}
