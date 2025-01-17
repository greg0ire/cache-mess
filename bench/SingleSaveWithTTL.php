<?php
declare(strict_types=1);

namespace Lcobucci\CacheBench;

/** @AfterMethods({"cleanup"}) */
final class SingleSaveWithTTL extends CacheComparison
{
    public function cleanup(): void
    {
        $this->psr16Roave->delete('save-with-ttl');
        $this->psr6Symfony->deleteItem('save-with-ttl');
    }

    public function benchPsr16Roave(): void
    {
        $this->psr16Roave->set('save-with-ttl', 'a-simple-item', 86400);
    }

    public function benchPsr6Symfony(): void
    {
        $item = $this->psr6Symfony->getItem('save-with-ttl')->set('a-simple-item')->expiresAfter(86400);

        $this->psr6Symfony->save($item);
    }
}
