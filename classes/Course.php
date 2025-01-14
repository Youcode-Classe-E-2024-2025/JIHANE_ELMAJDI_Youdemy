<?php
class Course {
    private $id;
    private $title;
    private $description;
    private $category_id;
    private $created_at;

    public function __construct($title = "", $description = "", $category_id = 0) {
        $this->title = $title;
        $this->description = $description;
        $this->category_id = $category_id;
    }

    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getCategoryId() {
        return $this->category_id;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
}
