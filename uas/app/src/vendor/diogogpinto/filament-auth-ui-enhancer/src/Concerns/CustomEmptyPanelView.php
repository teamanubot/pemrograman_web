<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

trait CustomEmptyPanelView
{
    public ?string $emptyPanelView = null;

    public function emptyPanelView(string $view): self
    {
        $this->emptyPanelView = $view;

        return $this;
    }

    public function getEmptyPanelView(): ?string
    {
        return $this->emptyPanelView;
    }
}
