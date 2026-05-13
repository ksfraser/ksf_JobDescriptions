<?php

declare(strict_types=1);

namespace Ksfraser\JobDescriptions\Service;

use Ksfraser\JobDescriptions\Entity\JobDescription;
use Ksfraser\JobDescriptions\Entity\JobGrade;

class JobDescriptionService
{
    private array $jobDescriptions = [];
    private array $grades = [];

    public function createJobDescription(array $data): JobDescription
    {
        $jd = JobDescription::fromArray($data);
        $id = $jd->getId() ?? count($this->jobDescriptions) + 1;
        $jd->setId($id);
        $this->jobDescriptions[$id] = $jd;
        return $jd;
    }

    public function getJobDescription(int $id): ?JobDescription
    {
        return $this->jobDescriptions[$id] ?? null;
    }

    public function updateJobDescription(int $id, array $data): ?JobDescription
    {
        $jd = $this->getJobDescription($id);
        if ($jd === null) return null;

        foreach (['title', 'summary', 'responsibilities', 'requirements', 'skills', 'department', 'status'] as $field) {
            if (isset($data[$field])) {
                $method = 'set' . ucfirst($field);
                $jd->$method($data[$field]);
            }
        }
        $jd->setUpdatedAt(date('Y-m-d H:i:s'));
        return $jd;
    }

    public function deleteJobDescription(int $id): bool
    {
        if (!isset($this->jobDescriptions[$id])) return false;
        unset($this->jobDescriptions[$id]);
        return true;
    }

    public function getActiveJobDescriptions(): array
    {
        return array_values(array_filter(
            $this->jobDescriptions,
            fn($jd) => $jd->isActive()
        ));
    }

    public function getJobDescriptionsByDepartment(string $department): array
    {
        return array_values(array_filter(
            $this->jobDescriptions,
            fn($jd) => $jd->getDepartment() === $department && $jd->isActive()
        ));
    }

    public function searchJobDescriptions(string $keyword): array
    {
        $keyword = strtolower($keyword);
        return array_values(array_filter(
            $this->jobDescriptions,
            fn($jd) =>
                str_contains(strtolower($jd->getTitle()), $keyword) ||
                str_contains(strtolower($jd->getSummary()), $keyword) ||
                str_contains(strtolower($jd->getSkills()), $keyword)
        ));
    }

    public function createGrade(array $data): JobGrade
    {
        $grade = JobGrade::fromArray($data);
        $id = $grade->getId() ?? count($this->grades) + 1;
        $grade->setId($id);
        $this->grades[$id] = $grade;
        return $grade;
    }

    public function getGrade(int $id): ?JobGrade
    {
        return $this->grades[$id] ?? null;
    }

    public function assignGradeToJob(int $jobId, int $gradeId): ?JobDescription
    {
        $jd = $this->getJobDescription($jobId);
        if ($jd === null) return null;
        $jd->setGradeId($gradeId);
        return $jd;
    }

    public function getActiveGrades(): array
    {
        return array_values(array_filter($this->grades, fn($g) => $g->isActive()));
    }
}