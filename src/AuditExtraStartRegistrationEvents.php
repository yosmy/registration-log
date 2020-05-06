<?php

namespace Yosmy;

use Yosmy;
use Traversable;

/**
 * @di\service()
 */
class AuditExtraStartRegistrationEvents
{
    /**
     * @var ManageEventCollection
     */
    private $manageEventCollection;

    /**
     * @param ManageEventCollection $manageEventCollection
     */
    public function __construct(
        ManageEventCollection $manageEventCollection
    ) {
        $this->manageEventCollection = $manageEventCollection;
    }

    /**
     * @param Yosmy\Mongo\ManageCollection $manageCollection
     *
     * @return Traversable
     */
    public function audit(
        Yosmy\Mongo\ManageCollection $manageCollection
    ): Traversable
    {
        return $this->manageEventCollection->aggregate(
            [
                [
                    '$lookup' => [
                        'localField' => 'involved.user',
                        'from' => $manageCollection->getName(),
                        'as' => 'parent',
                        'foreignField' => '_id',
                    ]
                ],
                [
                    '$match' => [
                        'labels' => [
                            '$in' => [
                                'yosmy.start_registration'
                            ]
                        ],
                        'parent._id' => [
                            '$exists' => false
                        ]
                    ],
                ]
            ]
        );
    }
}