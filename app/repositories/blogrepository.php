<?php   

namespace App\Repositories;

use App\Models\Blog;

use PDO;

class BlogRepository extends Repository{

    public function getAll()
    {
        $sql = "SELECT content_id, content_type, title, content, image_name FROM blog";
        $rows = $this->executeQuery($sql);

        // Check if there are rows
        if (!$rows) {
            echo "No articles found.";
            return [];
        }

        // Check if the mapping is working
        return $this->mapToBlogObjects($rows);
    }

    private function mapToBlogObjects($rows)
    {
        $blogs = [];

        foreach ($rows as $row) {
            $blog = new Blog();
            $blog->setContentId($row['content_id']);
            $blog->setContentType($row['content_type']);
            $blog->setTitle($row['title']);
            $blog->setContent($row['content']);
            $blog->setImageName($row['image_name']);
            // Map other properties as needed

            $blogs[] = $blog;
        }

        return $blogs;
    }

    private function executeQuery($sql)
    {
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException("Query execution failed: " . $e->getMessage());
        }
    }

}