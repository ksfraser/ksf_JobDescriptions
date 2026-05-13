<?php

declare(strict_types=1);

namespace Ksfraser\JobDescriptions\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\JobDescriptions\Entity\JobGrade;

class JobGradeTest extends TestCase
{
    public function testCanCreateJobGrade(): void
    {
        $grade = new JobGrade();
        $this->assertInstanceOf(JobGrade::class, $grade);
    }

    public function testCanSetAndGetName(): void
    {
        $grade = new JobGrade();
        $grade->setName('Level 1');
        $this->assertEquals('Level 1', $grade->getName());
    }

    public function testCanSetAndGetLevel(): void
    {
        $grade = new JobGrade();
        $grade->setLevel(5);
        $this->assertEquals(5, $grade->getLevel());
    }

    public function testCanSetAndGetMinSalary(): void
    {
        $grade = new JobGrade();
        $grade->setMinSalary(50000);
        $this->assertEquals(50000, $grade->getMinSalary());
    }

    public function testCanSetAndGetMaxSalary(): void
    {
        $grade = new JobGrade();
        $grade->setMaxSalary(100000);
        $this->assertEquals(100000, $grade->getMaxSalary());
    }

    public function testCanSetAndGetCurrency(): void
    {
        $grade = new JobGrade();
        $this->assertEquals('CAD', $grade->getCurrency());
        $grade->setCurrency('USD');
        $this->assertEquals('USD', $grade->getCurrency());
    }

    public function testCanSetAndGetStatus(): void
    {
        $grade = new JobGrade();
        $this->assertEquals(JobGrade::STATUS_ACTIVE, $grade->getStatus());
        $grade->setStatus(JobGrade::STATUS_INACTIVE);
        $this->assertEquals(JobGrade::STATUS_INACTIVE, $grade->getStatus());
    }

    public function testIsActive(): void
    {
        $grade = new JobGrade();
        $this->assertTrue($grade->isActive());

        $grade->setStatus(JobGrade::STATUS_INACTIVE);
        $this->assertFalse($grade->isActive());
    }

    public function testGetSalaryRange(): void
    {
        $grade = new JobGrade();
        $grade->setMinSalary(50000);
        $grade->setMaxSalary(100000);
        $grade->setCurrency('CAD');

        $this->assertEquals('CAD 50000 - 100000', $grade->getSalaryRange());
    }

    public function testGetSalaryRangeWithDifferentCurrency(): void
    {
        $grade = new JobGrade();
        $grade->setMinSalary(75000);
        $grade->setMaxSalary(150000);
        $grade->setCurrency('USD');

        $this->assertEquals('USD 75000 - 150000', $grade->getSalaryRange());
    }

    public function testFromArray(): void
    {
        $data = [
            'id' => 5,
            'name' => 'Senior Level',
            'level' => 4,
            'min_salary' => 80000,
            'max_salary' => 150000,
            'currency' => 'CAD',
            'status' => JobGrade::STATUS_ACTIVE,
        ];

        $grade = JobGrade::fromArray($data);

        $this->assertEquals(5, $grade->getId());
        $this->assertEquals('Senior Level', $grade->getName());
        $this->assertEquals(4, $grade->getLevel());
        $this->assertEquals(80000, $grade->getMinSalary());
        $this->assertEquals(150000, $grade->getMaxSalary());
        $this->assertEquals('CAD', $grade->getCurrency());
        $this->assertTrue($grade->isActive());
    }

    public function testFromArrayWithDefaults(): void
    {
        $data = [
            'name' => 'Entry Level',
        ];

        $grade = JobGrade::fromArray($data);

        $this->assertEquals('Entry Level', $grade->getName());
        $this->assertEquals(1, $grade->getLevel());
        $this->assertEquals(0, $grade->getMinSalary());
        $this->assertEquals(0, $grade->getMaxSalary());
        $this->assertEquals('CAD', $grade->getCurrency());
        $this->assertTrue($grade->isActive());
    }

    public function testFluentInterface(): void
    {
        $grade = (new JobGrade())
            ->setName('Manager')
            ->setLevel(6)
            ->setMinSalary(90000)
            ->setMaxSalary(180000)
            ->setStatus(JobGrade::STATUS_ACTIVE);

        $this->assertEquals('Manager', $grade->getName());
        $this->assertEquals(6, $grade->getLevel());
        $this->assertEquals(90000, $grade->getMinSalary());
        $this->assertEquals(180000, $grade->getMaxSalary());
    }

    public function testDefaultCurrencyIsCAD(): void
    {
        $grade = new JobGrade();
        $this->assertEquals('CAD', $grade->getCurrency());
    }

    public function testDefaultLevelIsOne(): void
    {
        $grade = new JobGrade();
        $this->assertEquals(1, $grade->getLevel());
    }

    public function testSetAndGetId(): void
    {
        $grade = new JobGrade();
        $grade->setId(15);
        $this->assertEquals(15, $grade->getId());
    }
}