<?php

namespace App\Services;
use App\Services\Interfaces\CourseServiceInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Models\Course;

class CourseService implements CourseServiceInterface
{
    public function __construct(CourseRepositoryInterface $courseRepository) {
        $this->courseRepository = $courseRepository;
    }

    public function paginate() {
        $courses = $this->courseRepository->getAllPaginate();
        return $courses;
    }
}
