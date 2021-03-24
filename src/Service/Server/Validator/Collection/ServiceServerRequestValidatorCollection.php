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
 * Copyright (c) 2021 (original work) Open Assessment Technologies SA;
 */

declare(strict_types=1);

namespace OAT\Library\Lti1p3Core\Service\Server\Validator\Collection;

use OAT\Library\Lti1p3Core\Service\Server\Validator\ServiceServerRequestValidatorInterface;
use OAT\Library\Lti1p3Core\Util\Collection\Collection;
use OAT\Library\Lti1p3Core\Util\Collection\CollectionInterface;

class ServiceServerRequestValidatorCollection implements ServiceServerRequestValidatorCollectionInterface
{
    /** @var ServiceServerRequestValidatorInterface[]|CollectionInterface */
    private $validators;

    public function __construct(array $validators = [])
    {
        $this->validators = new Collection();

        foreach ($validators as $validator) {
            $this->add($validator);
        }
    }

    public function add(ServiceServerRequestValidatorInterface $validator): ServiceServerRequestValidatorCollectionInterface
    {
        $this->validators->set(get_class($validator), $validator);

        return $this;
    }

    public function all(): array
    {
        return $this->validators->all();
    }
}
