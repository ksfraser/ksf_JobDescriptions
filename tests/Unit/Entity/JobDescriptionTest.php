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
}