<?php

declare(strict_types=1);

namespace Ksfraser\JobDescriptions\Entity;

class JobDescription
{
    public const STATUS_DRAFT = 'Draft';
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_INACTIVE = 'Inactive';
    public const STATUS_ARCHIVED = 'Archived';

    private ?int $id = null;
    private string $title = '';
    private string $summary = '';
    private string $responsibilities = '';
    private string $requirements = '';
    private string $skills = '';
    private ?int $gradeId = null;
    private string $department = '';
    private string $status = self::STATUS_ACTIVE;
    private ?int $createdBy = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

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
    public function getCreatedBy(): ?int { return $this->createdBy; }
    public function setCreatedBy(?int $createdBy): self { $this->createdBy = $createdBy; return $this; }
    public function getCreatedAt(): ?string { return $this->createdAt; }
    public function setCreatedAt(?string $createdAt): self { $this->createdAt = $createdAt; return $this; }
    public function getUpdatedAt(): ?string { return $this->updatedAt; }
    public function setUpdatedAt(?string $updatedAt): self { $this->updatedAt = $updatedAt; return $this; }

    public function isActive(): bool { return $this->status === self::STATUS_ACTIVE; }
    public function isDraft(): bool { return $this->status === self::STATUS_DRAFT; }
    public function isArchived(): bool { return $this->status === self::STATUS_ARCHIVED; }

    public function activate(): void { $this->status = self::STATUS_ACTIVE; }
    public function archive(): void { $this->status = self::STATUS_ARCHIVED; }
    public function deactivate(): void { $this->status = self::STATUS_INACTIVE; }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->summary,
            'responsibilities' => $this->responsibilities,
            'requirements' => $this->requirements,
            'skills' => $this->skills,
            'grade_id' => $this->gradeId,
            'department' => $this->department,
            'status' => $this->status,
            'created_by' => $this->createdBy,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public static function fromArray(array $data): self
    {
        $jd = new self();
        $jd->setId($data['id'] ?? null);
        $jd->setTitle($data['title'] ?? '');
        $jd->setSummary($data['summary'] ?? '');
        $jd->setResponsibilities($data['responsibilities'] ?? '');
        $jd->setRequirements($data['requirements'] ?? '');
        $jd->setSkills($data['skills'] ?? '');
        $jd->setGradeId($data['grade_id'] ?? null);
        $jd->setDepartment($data['department'] ?? '');
        $jd->setStatus($data['status'] ?? self::STATUS_ACTIVE);
        $jd->setCreatedBy($data['created_by'] ?? null);
        $jd->setCreatedAt($data['created_at'] ?? null);
        $jd->setUpdatedAt($data['updated_at'] ?? null);
        return $jd;
    }
}