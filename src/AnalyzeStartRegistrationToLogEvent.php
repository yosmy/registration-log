<?php

namespace Yosmy;

/**
 * @di\service({
 *     tags: [
 *         'yosmy.start_registration',
 *     ]
 * })
 */
class AnalyzeStartRegistrationToLogEvent implements AnalyzeStartRegistration
{
    /**
     * @var LogEvent
     */
    private $logEvent;

    /**
     * @param LogEvent $logEvent
     */
    public function __construct(
        LogEvent $logEvent
    ) {
        $this->logEvent = $logEvent;
    }

    /**
     * {@inheritDoc}
     */
    public function analyze(
        string $device,
        string $country,
        string $prefix,
        string $number,
        array $roles
    ) {
        $this->logEvent->log(
            [
                'yosmy.start_registration',
            ],
            [
                'device' => $device,
                'country' => $country,
                'prefix' => $prefix,
                'number' => $number,
                'roles' => $roles,
            ],
            []
        );
    }
}
