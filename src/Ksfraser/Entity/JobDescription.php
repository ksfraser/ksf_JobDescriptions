<?php

declare(strict_types=1);

namespace Ksfraser\JobDescriptions\Entity;

class JobDescription
{
    private ?int $id = null;
    private string $title = '';
    private string $summary = '';
    private string $responsibilities = '';
    private string $requirements = '';
    private string $skills = '';
    private ?int $gradeId = null;
    private string $department = '';
    private string $status = 'Active';

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function getSummary(): string { return $this->summary; }
    public function setSummary(string $summary): self { $this->summary = $summary; return $this; }
    public function getResponsibilities(): string { return $this->responsibilities; }
    public function setResponsibilities(string $responsibilities): self { $this->responsibilities = $responsibilities; return $this; }
    public function getRequirements(): string { return $this->requirements; }
    public function setRequirements(string $requirements): self { $this->requirements = $requirements; return $this; }
    public function getSkills(): string { return $this->skills; }
    public function setSkills(string $skills): self { $this->skills = $skills; return $this; }
    public function getGradeId(): ?int { return $this->gradeId; }
    public function setGradeId(?int $gradeId): self { $this->gradeId = $gradeId; return $this; }
    public function getDepartment(): string { return $this->department; }
    public function setDepartment(string $department): self { $this->department = $department; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function isActive(): bool { return $this->status === 'Active'; }
}