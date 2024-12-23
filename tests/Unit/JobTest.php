<?php

namespace Tests\Unit;

use App\Models\Employer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Job;

class JobTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_jobs(): void
    {
        $employers = Employer::factory(100)->create();
        for ($i = 0; $i < 100; $i++) {
            Job::factory()->create([
                'employer_id' => $employers->random()->id
            ]);
        }

        $job = Job::all();

        $this->assertCount(100, $job);
    }

    public function test_filter_jobs_by_title_or_description()
    {
        $employers = Employer::factory(3)->create();
        $jobList = [
            [
                "title" => "Job A",
                "description" => "Job A desc",
                "salary" => 2000,
                "location" => "NY",
                "category" => "IT",
                "experience" => "intermediate",
                "employer_id"=> $employers->random()->id,
            ],

            [
                "title" => "Job B",
                "description" => "Job B desc",
                "salary" => 1000,
                "location" => "Rome",
                "category" => "Marketing",
                "experience" => "entry",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job C",
                "description" => "Job C desc",
                "salary" => 3000,
                "location" => "Beijing",
                "category" => "Sales",
                "experience" => "senior",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job A-1",
                "description" => "Job A-1 desc",
                "salary" => 5000,
                "location" => "NY",
                "category" => "IT",
                "experience" => "senior",
                "employer_id" => $employers->random()->id,
            ]
        ];

        foreach ($jobList as $job) {
            Job::factory()->create($job);
        }

        $filterByTitle = [
            'search' => 'Job A',
        ];

        $filterByDesc = [
            'search' => '-1',
        ];

        $filteredJobsByTitle = Job::filter($filterByTitle)->get();
        $filteredJobsByDesc = Job::filter($filterByDesc)->get();

        $this->assertCount(2, $filteredJobsByTitle);
        $this->assertCount(1, $filteredJobsByDesc);
    }

    public function test_filter_jobs_by_salary()
    {
        $employers = Employer::factory(3)->create();
        $jobList = [
            [
                "title" => "Job A",
                "description" => "Job A desc",
                "salary" => 2000,
                "location" => "NY",
                "category" => "IT",
                "experience" => "intermediate",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job B",
                "description" => "Job B desc",
                "salary" => 1000,
                "location" => "Rome",
                "category" => "Marketing",
                "experience" => "entry",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job C",
                "description" => "Job C desc",
                "salary" => 3000,
                "location" => "Beijing",
                "category" => "Sales",
                "experience" => "senior",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job A-1",
                "description" => "Job A-1 desc",
                "salary" => 5000,
                "location" => "NY",
                "category" => "IT",
                "experience" => "senior",
                "employer_id" => $employers->random()->id,
            ]
        ];

        foreach ($jobList as $job) {
            Job::factory()->create($job);
        }

        $filterByMinSalary = [
            'min_salary' => 2000,
        ];

        $filterByMaxSalary = [
            'max_salary' => 2000,
        ];

        $filterBySalary = [
            'min_salary' => 3000,
            'max_salary' => 4000,
        ];

        $filteredJobsByMinSalary = Job::filter($filterByMinSalary)->get();
        $filteredJobsByMaxSalary = Job::filter($filterByMaxSalary)->get();
        $filteredJobsBySalary = Job::filter($filterBySalary)->get();

        $this->assertCount(3, $filteredJobsByMinSalary);
        $this->assertCount(2, $filteredJobsByMaxSalary);
        $this->assertCount(1, $filteredJobsBySalary);
    }

    public function test_filter_jobs_by_experience()
    {
        $employers = Employer::factory(3)->create();
        $jobList = [
            [
                "title" => "Job A",
                "description" => "Job A desc",
                "salary" => 2000,
                "location" => "NY",
                "category" => "IT",
                "experience" => "intermediate",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job B",
                "description" => "Job B desc",
                "salary" => 1000,
                "location" => "Rome",
                "category" => "Marketing",
                "experience" => "entry",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job C",
                "description" => "Job C desc",
                "salary" => 3000,
                "location" => "Beijing",
                "category" => "Sales",
                "experience" => "senior",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job A-1",
                "description" => "Job A-1 desc",
                "salary" => 5000,
                "location" => "NY",
                "category" => "IT",
                "experience" => "senior",
                "employer_id" => $employers->random()->id,
            ]
        ];

        foreach ($jobList as $job) {
            Job::factory()->create($job);
        }

        $filterByExperience = [
            'experience' => 'senior',
        ];

        $filteredJobsByExperience = Job::filter($filterByExperience)->get();

        $this->assertCount(2, $filteredJobsByExperience);
    }

    public function test_filter_jobs_by_category()
    {
        $employers = Employer::factory(3)->create();
        $jobList = [
            [
                "title" => "Job A",
                "description" => "Job A desc",
                "salary" => 2000,
                "location" => "NY",
                "category" => "IT",
                "experience" => "intermediate",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job B",
                "description" => "Job B desc",
                "salary" => 1000,
                "location" => "Rome",
                "category" => "Marketing",
                "experience" => "entry",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job C",
                "description" => "Job C desc",
                "salary" => 3000,
                "location" => "Beijing",
                "category" => "Sales",
                "experience" => "senior",
                "employer_id" => $employers->random()->id,
            ],

            [
                "title" => "Job A-1",
                "description" => "Job A-1 desc",
                "salary" => 5000,
                "location" => "NY",
                "category" => "IT",
                "experience" => "senior",
                "employer_id" => $employers->random()->id,
            ]
        ];

        foreach ($jobList as $job) {
            Job::factory()->create($job);
        }

        $filterByCategory = [
            'category' => 'IT',
        ];

        $filteredJobsByCategory = Job::filter($filterByCategory)->get();

        $this->assertCount(2, $filteredJobsByCategory);
    }
}
