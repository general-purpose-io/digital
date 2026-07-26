<?php

namespace GeneralPurposeIO\Digital;

use GeneralPurposeIO\Contracts\Digital\DigitalIODriver;

class DigitalInputPin
{
    public function __construct(
        public readonly int $pin,
        protected DigitalIODriver $driver,
    ) {}

    public function read(): bool
    {
        return $this->driver->read($this->pin);
    }

    public function isHigh(): bool
    {
        return $this->read();
    }

    public function isLow(): bool
    {
        return !$this->read();
    }

    public function listen(bool $rising_events = false, bool $falling_events = false, int $timeout_ms = 1000): ?DigitalEdgeEvent
    {
        return $this->driver->listen($timeout_ms, $rising_events, $falling_events, $this->pin);
    }

    public function close(): void
    {
        $this->driver->close();
    }
}