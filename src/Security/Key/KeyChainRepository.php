<?php

/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2020 (original work) Open Assessment Technologies SA;
 */

declare(strict_types=1);

namespace OAT\Library\Lti1p3Core\Security\Key;

class KeyChainRepository implements KeyChainRepositoryInterface
{
    /** @var KeyChainInterface[] */
    private $keyChains;

    public function __construct(array $keyChains = [])
    {
        foreach ($keyChains as $keyChain) {
            $this->addKeyChain($keyChain);
        }
    }

    public function addKeyChain(KeyChainInterface $keyChain): self
    {
        $this->keyChains[$keyChain->getIdentifier()] = $keyChain;

        return $this;
    }

    public function find(string $identifier): ?KeyChainInterface
    {
        return $this->keyChains[$identifier] ?? null;
    }

    /**
     * @return KeyChainInterface[]
     */
    public function findByKeySetName(string $keySetName): array
    {
        $keyChains = [];

        foreach ($this->keyChains as $keyChain) {
            if ($keyChain->getKeySetName() === $keySetName) {
                $keyChains[$keyChain->getIdentifier()] = $keyChain;
            }
        }

        return $keyChains;
    }
}
