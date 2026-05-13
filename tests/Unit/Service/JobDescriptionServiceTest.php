<?php

declare(strict_types=1);

namespace Ksfraser\JobDescriptions\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use Ksfraser\JobDescriptions\Service\JobDescriptionService;
use Ksfraser\JobDescriptions\Entity\JobDescription;
use Ksfraser\JobDescriptions\Entity\JobGrade;

class JobDescriptionServiceTest extends TestCase
{
    private JobDescriptionService $service;

    protected function setUp(): void
    {
        $this->service = new JobDescriptionService();
    }

    public function testCanCreateJobDescriptionService(): void
    {
        $this->assertInstanceOf(JobDescriptionService::class, $this->service);
    }

    public function testCreateJobDescription(): void
    {
        $data = [
            'title' => 'Software Developer',
            'department' => 'IT',
            'summary' => 'Develop software',
        ];

        $jd = $this->service->createJobDescription($data);

        $this->assertInstanceOf(JobDescription::class, $jd);
        $this->assertEquals('Software Developer', $jd->getTitle());
        $this->assertEquals('IT', $jd->getDepartment());
        $this->assertEquals('Develop software', $jd->getSummary());
    }

    public function testGetJobDescription(): void
    {
        $jd = $this->service->createJobDescription([
            'title' => 'Test Job',
            'department' => 'Test',
        ]);

        $found = $this->service->getJobDescription($jd->getId());

        $this->assertNotNull($found);
        $this->assertEquals($jd->getId(), $found->getId());
    }

    public function testGetNonExistentJobDescription(): void
    {
        $found = $this->service->getJobDescription(9999);
        $this->assertNull($found);
    }

    public function testUpdateJobDescription(): void
    {
        $jd = $this->service->createJobDescription([
            'title' => 'Original Title',
            'department' => 'IT',
        ]);

        $updated = $this->service->updateJobDescription($jd->getId(), [
            'title' => 'Updated Title',
            'summary' => 'New summary',
        ]);

        $this->assertNotNull($updated);
        $this->assertEquals('Updated Title', $updated->getTitle());
        $this->assertEquals('New summary', $updated->getSummary());
        $this->assertEquals('IT', $updated->getDepartment());
    }

    public function testUpdateNonExistentJobDescription(): void
    {
        $updated = $this->service->updateJobDescription(9999, ['title' => 'Test']);
        $this->assertNull($updated);
    }

    public function testDeleteJobDescription(): void
    {
        $jd = $this->service->createJobDescription([
            'title' => 'To Delete',
            'department' => 'IT',
        ]);

        $id = $jd->getId();
        $result = $this->service->deleteJobDescription($id);

        $this->assertTrue($result);
        $this->assertNull($this->service->getJobDescription($id));
    }

    public function testDeleteNonExistentJobDescription(): void
    {
        $result = $this->service->deleteJobDescription(9999);
        $this->assertFalse($result);
    }

    public function testGetActiveJobDescriptions(): void
    {
        $this->service->createJobDescription([
            'title' => 'Active Job 1',
            'department' => 'IT',
            'status' => JobDescription::STATUS_ACTIVE,
        ]);
        $this->service->createJobDescription([
            'title' => 'Archived Job',
            'department' => 'IT',
            'status' => JobDescription::STATUS_ARCHIVED,
        ]);
        $this->service->createJobDescription([
            'title' => 'Active Job 2',
            'department' => 'HR',
            'status' => JobDescription::STATUS_ACTIVE,
        ]);

        $active = $this->service->getActiveJobDescriptions();

        $this->assertCount(2, $active);
        foreach ($active as $jd) {
            $this->assertTrue($jd->isActive());
        }
    }

    public function testGetJobDescriptionsByDepartment(): void
    {
        $this->service->createJobDescription([
            'title' => 'IT Job',
            'department' => 'IT',
        ]);
        $this->service->createJobDescription([
            'title' => 'HR Job',
            'department' => 'HR',
        ]);
        $this->service->createJobDescription([
            'title' => 'Another IT Job',
            'department' => 'IT',
        ]);

        $itJobs = $this->service->getJobDescriptionsByDepartment('IT');

        $this->assertCount(2, $itJobs);
        foreach ($itJobs as $jd) {
            $this->assertEquals('IT', $jd->getDepartment());
        }
    }

    public function testSearchJobDescriptions(): void
    {
        $this->service->createJobDescription([
            'title' => 'PHP Developer',
            'skills' => 'PHP, MySQL',
        ]);
        $this->service->createJobDescription([
            'title' => 'Java Developer',
            'skills' => 'Java, Spring',
        ]);
        $this->service->createJobDescription([
            'title' => 'Full Stack Dev',
            'skills' => 'PHP, React, MySQL',
        ]);

        $results = $this->service->searchJobDescriptions('PHP');

        $this->assertCount(2, $results);
    }

    public function testCreateGrade(): void
    {
        $grade = $this->service->createGrade([
            'name' => 'Level 1',
            'level' => 1,
            'min_salary' => 40000,
            'max_salary' => 60000,
        ]);

        $this->assertInstanceOf(JobGrade::class, $grade);
        $this->assertEquals('Level 1', $grade->getName());
        $this->assertEquals(1, $grade->getLevel());
        $this->assertEquals(40000, $grade->getMinSalary());
        $this->assertEquals(60000, $grade->getMaxSalary());
    }

    public function testGetGrade(): void
    {
        $grade = $this->service->createGrade(['name' => 'Test Grade', 'level' => 3]);
        $found = $this->service->getGrade($grade->getId());

        $this->assertNotNull($found);
        $this->assertEquals($grade->getId(), $found->getId());
    }

    public function testAssignGradeToJob(): void
    {
        $jd = $this->service->createJobDescription(['title' => 'Senior Dev']);
        $grade = $this->service->createGrade(['name' => 'Senior', 'level' => 5]);

        $result = $this->service->assignGradeToJob($jd->getId(), $grade->getId());

        $this->assertNotNull($result);
        $this->assertEquals($grade->getId(), $result->getGradeId());
    }

    public function testGetActiveGrades(): void
    {
        $this->service->createGrade([
            'name' => 'Active Grade',
            'status' => JobGrade::STATUS_ACTIVE,
        ]);
        $this->service->createGrade([
            'name' => 'Inactive Grade',
            'status' => JobGrade::STATUS_INACTIVE,
        ]);

        $active = $this->service->getActiveGrades();

        $this->assertCount(1, $active);
        $this->assertEquals('Active Grade', $active[0]->getName());
    }
}