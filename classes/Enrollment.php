<?php
class Enrollement {
    private $id;
    private $user_id;
    private $cours_id;
    private $enrolled_at;

    public function __construct($user_id = 0, $cours_id = 0) {
        $this->user_id = $user_id;
        $this->cours_id = $cours_id;
    }

    public function getId() {
        return $this->id;
    }
    public function getUserId() {
        return $this->user_id;
    }
    public function getCoursId() {
        return $this->cours_id;
    }
    public function getEnrolledAt() {
        return $this->enrolled_at;
    }
}