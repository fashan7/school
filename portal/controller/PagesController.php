<?php

class PagesController {

    public function index() {
        view('index');
    }

    public function errlog() {
        view('err404', compact(null));
    }

    public function login() {
        view("login");
    }

    public function lockscreen() {
        view("lockscreen");
    }

    public function Exam() {
        $title = "Exam Engine | Universal Virtual MCQ Exam Engine";
        view('Exam', compact('title'));
    }

    public function StudentDetails() {
        view("StudentDetails");
    }

}
