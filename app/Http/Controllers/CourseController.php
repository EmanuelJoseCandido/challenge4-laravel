<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCourseRankRequest;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Update the ranking of specific courses
     *
     * @param  UpdateCourseRankRequest $updateCourseRankRequest
     * @return void
     */
    public function rank(UpdateCourseRankRequest $updateCourseRankRequest): void
    {
        $input = $updateCourseRankRequest->validated();
        $course = new Course();

        $firstChange = $course->find($input['firstId']);
        $secondChange = $course->find($input['secondId']);

        $aux = $firstChange->ranking;
        $firstChange->ranking = $secondChange->ranking;
        $secondChange->ranking = $aux;

        $firstChange->save();
        $secondChange->save();
    }
}
