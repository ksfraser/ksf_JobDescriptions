<?php

declare(strict_types=1);

namespace Ksfraser\JobDescriptions\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\JobDescriptions\Entity\JobDescription;

class JobDescriptionTest extends TestCase
{
    public function testCanCreateJobDescription(): void
    {
        $jd = new JobDescription();
        $this->assertInstanceOf(JobDescription::class, $jd);
    }

    public function testCanSetAndGetTitle(): void
    {
        $jd = new JobDescription();
        $jd->setTitle('Software Developer');
        $this->assertEquals('Software Developer', $jd->getTitle());
    }

    public function testCanSetAndGetDepartment(): void
    {
        $jd = new JobDescription();
        $jd->setDepartment('Engineering');
        $this->assertEquals('Engineering', $jd->getDepartment());
    }

    public function testCanSetAndGetSummary(): void
    {
        $jd = new JobDescription();
        $jd->setSummary('Job summary text');
        $this->assertEquals('Job summary text', $jd->getSummary());
    }

    public function testCanSetAndGetResponsibilities(): void
    {
        $jd = new JobDescription();
        $jd->setResponsibilities('Responsibility 1, Responsibility 2');
        $this->assertEquals('Responsibility 1, Responsibility 2', $jd->getResponsibilities());
    }

    public function testCanSetAndGetRequirements(): void
    {
        $jd = new JobDescription();
        $jd->setRequirements('5 years experience');
        $this->assertEquals('5 years experience', $jd->getRequirements());
    }

    public function testCanSetAndGetSkills(): void
    {
        $jd = new JobDescription();
        $jd->setSkills('PHP, JavaScript, MySQL');
        $this->assertEquals('PHP, JavaScript, MySQL', $jd->getSkills());
    }

    public function testCanSetAndGetGradeId(): void
    {
        $jd = new JobDescription();
        $jd->setGradeId(5);
        $this->assertEquals(5, $jd->getGradeId());
    }

    public function testCanSetAndGetStatus(): void
    {
        $jd = new JobDescription();
        $this->assertEquals(JobDescription::STATUS_ACTIVE, $jd->getStatus());
        $jd->setStatus(JobDescription::STATUS_DRAFT);
        $this->assertEquals(JobDescription::STATUS_DRAFT, $jd->getStatus());
    }

    public function testIsActive(): void
    {
        $jd = new JobDescription();
        $this->assertTrue($jd->isActive());

        $jd->setStatus(JobDescription::STATUS_INACTIVE);
        $this->assertFalse($jd->isActive());
    }

    public function testIsDraft(): void
    {
        $jd = new JobDescription();
        $jd->setStatus(JobDescription::STATUS_DRAFT);
        $this->assertTrue($jd->isDraft());
        $this->assertFalse($jd->isActive());
    }

    public function testIsArchived(): void
    {
        $jd = new JobDescription();
        $jd->setStatus(JobDescription::STATUS_ARCHIVED);
        $this->assertTrue($jd->isArchived());
    }

    public function testActivate(): void
    {
        $jd = new JobDescription();
        $jd->setStatus(JobDescription::STATUS_DRAFT);
        $jd->activate();
        $this->assertTrue($jd->isActive());
    }

    public function testArchive(): void
    {
        $jd = new JobDescription();
        $jd->archive();
        $this->assertTrue($jd->isArchived());
    }

    public function testDeactivate(): void
    {
        $jd = new JobDescription();
        $jd->deactivate();
        $this->assertEquals(JobDescription::STATUS_INACTIVE, $jd->getStatus());
    }

    public function testToArray(): void
    {
        $jd = new JobDescription();
        $jd->setId(1);
        $jd->setTitle('Test Developer');
        $jd->setDepartment('IT');
        $jd->setStatus(JobDescription::STATUS_ACTIVE);

        $arr = $jd->toArray();

        $this->assertEquals(1, $arr['id']);
        $this->assertEquals('Test Developer', $arr['title']);
        $this->assertEquals('IT', $arr['department']);
        $this->assertEquals(JobDescription::STATUS_ACTIVE, $arr['status']);
    }

    public function testFromArray(): void
    {
        $data = [
            'id' => 10,
            'title' => 'Senior Developer',
            'department' => 'Engineering',
            'summary' => 'Senior role',
            'responsibilities' => 'Manage team',
            'requirements' => '10 years',
            'skills' => 'PHP, Python',
            'grade_id' => 3,
            'status' => JobDescription::STATUS_ACTIVE,
            'created_by' => 1,
        ];

        $jd = JobDescription::fromArray($data);

        $this->assertEquals(10, $jd->getId());
        $this->assertEquals('Senior Developer', $jd->getTitle());
        $this->assertEquals('Engineering', $jd->getDepartment());
        $this->assertEquals('Senior role', $jd->getSummary());
        $this->assertEquals(3, $jd->getGradeId());
        $this->assertTrue($jd->isActive());
    }

    public function testFluentInterface(): void
    {
        $jd = (new JobDescription())
            ->setTitle('Fluent Test')
            ->setDepartment('Test Dept')
            ->setStatus(JobDescription::STATUS_DRAFT);

        $this->assertEquals('Fluent Test', $jd->getTitle());
        $this->assertEquals('Test Dept', $jd->getDepartment());
        $this->assertTrue($jd->isDraft());
    }

    public function testDefaultStatusIsActive(): void
    {
        $jd = new JobDescription();
        $this->assertEquals(JobDescription::STATUS_ACTIVE, $jd->getStatus());
    }

    public function testCreatedByAndTimestamps(): void
    {
        $jd = new JobDescription();
        $jd->setCreatedBy(5);
        $jd->setCreatedAt('2026-01-01 10:00:00');
        $jd->setUpdatedAt('2026-01-02 12:00:00');

        $this->assertEquals(5, $jd->getCreatedBy());
        $this->assertEquals('2026-01-01 10:00:00', $jd->getCreatedAt());
        $this->assertEquals('2026-01-02 12:00:00', $jd->getUpdatedAt());
    }
}