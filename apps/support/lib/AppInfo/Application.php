<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2018, Morris Jobke <hey@morrisjobke.de>
 *
 * @author Morris Jobke <hey@morrisjobke.de>
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
 *
 */

namespace OCA\Support\AppInfo;

use OCA\Support\Notification\Notifier;
use OCA\Support\Subscription\SubscriptionAdapter;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\ILogger;
use OCP\Notification\IManager;
use OCP\Support\Subscription\Exception\AlreadyRegisteredException;
use OCP\Support\Subscription\IRegistry;

class Application extends App implements IBootstrap {

	public const APP_ID = 'support';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}

	public function register(IRegistrationContext $context): void {
	}

	public function boot(IBootContext $context): void {
		$container = $context->getAppContainer();

		/* @var $registry IRegistry */
		$registry = $container->query(IRegistry::class);
		try {
			$registry->registerService(SubscriptionAdapter::class);
		} catch (AlreadyRegisteredException $e) {
			$logger = $context->getServerContainer()->query(ILogger::class);
			$logger->logException($e, ['message' => 'Multiple subscription adapters are registered.', 'app' => 'support']);
		}

		$context->injectFn(\Closure::fromCallable([$this, 'registerNotifier']));
	}

	public function registerNotifier(IManager $notificationsManager) {
		$notificationsManager->registerNotifierService(Notifier::class);
	}
}
