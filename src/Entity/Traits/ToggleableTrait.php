<?php


namespace App\Entity\Traits;


use Doctrine\ORM\Mapping as ORM;

trait ToggleableTrait
{
    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": true})
     */
    protected bool $enabled = true;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = (bool) $enabled;
        return $this;
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }
}