<?php

/**
 * @copyright 2019 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @author 2019 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace Nextcloud\KItinerary;

use Nextcloud\KItinerary\Exception\KItineraryRuntimeException;

class ItineraryExtractor
{

	/** @var Adapter */
	private $adapter;

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
	}

	/**
	 * @param string $source
	 * @return Itinerary
	 * @throws KItineraryRuntimeException
	 */
	public function extractFromString(string $source): Itinerary
	{
		return new Itinerary(
			$this->adapter->extractFromString($source)
		);
	}

}
