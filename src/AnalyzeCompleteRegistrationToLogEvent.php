<?php

namespace Yosmy;

/**
 * @di\service({
 *     tags: [
 *         'yosmy.complete_registration',
 *     ]
 * })
 */
class AnalyzeCompleteRegistrationToLogEvent implements AnalyzeCompleteRegistration
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
        string $user
    ) {
        $this->logEvent->log(
            [
                'yosmy.complete_registration',
            ],
            [
                'device' => $device,
                'user' => $user,
            ],
            []
        );
    }
}
