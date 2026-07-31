<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;

class CreateCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:create{coursename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new course in the course table in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $courseName = $this->argument("coursename");
        Course::create(["name" => $courseName ? $courseName : "Samhoon Course ", "active" => 1]);
        $message = 'new course wes created with the name ';
        dump($message . $courseName);
    }
}
