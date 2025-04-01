<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\File;

class FileResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'files';
        $this->entityClass = File::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => false,
            'update' => false,
            'delete' => false,
        ];
    }
} 