<?php
class CourseTag {
    private $id;
    private $cours_id;
    private $tag_id;

    public function __construct($cours_id = 0, $tag_id = 0) {
        $this->cours_id = $cours_id;
        $this->tag_id = $tag_id;
    }

    public function getId() {
        return $this->id;
    }
    public function getCoursId() {
        return $this->cours_id;
    }
    public function getTagId() {
        return $this->tag_id;
    }
}