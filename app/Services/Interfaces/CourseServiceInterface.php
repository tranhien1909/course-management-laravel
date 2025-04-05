<?php

namespace App\Services\Interfaces;

interface CourseServiceInterface {

    public function paginate();

    public function create(array $data);
}