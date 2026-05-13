<?php

declare(strict_types=1);

namespace Ksfraser\JobDescriptions\Entity;

class JobGrade
{
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_INACTIVE = 'Inactive';

    private ?int $id = null;
    private string $name = '';
    private int $level = 1;
    private float $minSalary = 0;
    private float $maxSalary = 0;
    private string $currency = 'CAD';
    private string $status = self::STATUS_ACTIVE;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getLevel(): int { return $this->level; }
    public function setLevel(int $level): self { $this->level = $level; return $this; }
    public function getMinSalary(): float { return $this->minSalary; }
    public function setMinSalary(float $minSalary): self { $this->minSalary = $minSalary; return $this; }
    public function getMaxSalary(): float { return $this->maxSalary; }
    public function setMaxSalary(float $maxSalary): self { $this->maxSalary = $maxSalary; return $this; }
    public function getCurrency(): string { return $this->currency; }
    public function setCurrency(string $currency): self { $this->currency = $currency; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }

    public function isActive(): bool { return $this->status === self::STATUS_ACTIVE; }
    public function getSalaryRange(): string { return $this->currency . ' ' . $this->minSalary . ' - ' . $this->maxSalary; }

    public static function fromArray(array $data): self
    {
        $grade = new self();
        $grade->setId($data['id'] ?? null);
        $grade->setName($data['name'] ?? '');
        $grade->setLevel($data['level'] ?? 1);
        $grade->setMinSalary($data['min_salary'] ?? 0);
        $grade->setMaxSalary($data['max_salary'] ?? 0);
        $grade->setCurrency($data['currency'] ?? 'CAD');
        $grade->setStatus($data['status'] ?? self::STATUS_ACTIVE);
        return $grade;
    }
}