<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace DevTools {
	class DevTools{} //prevent ConsoleScript executing itself
}

namespace pmBuildScript {

	use function dirname;
	use function getcwd;
	use function getopt;
	use function sprintf;
	use const PHP_EOL;

	$opts = getopt("", ["output:", "preprocess"]);

	$output = $opts["output"] ?? getcwd();

	require dirname(__DIR__) . '/tests/plugins/PocketMine-DevTools/src/DevTools/ConsoleScript.php';

	foreach(buildPhar($output . '/DevTools.phar', dirname(__DIR__) . '/tests/plugins/PocketMine-DevTools', [], [], sprintf(DEVTOOLS_REQUIRE_FILE_STUB, 'src/DevTools/ConsoleScript.php')) as $message){
		echo $message . PHP_EOL;
	}

	foreach(buildPhar($output . '/PocketMine-MP.phar', dirname(__DIR__), ['src', 'vendor', 'resources'], [], sprintf(DEVTOOLS_REQUIRE_FILE_STUB, 'src/pocketmine/PocketMine.php')) as $message){
		echo $message . PHP_EOL;
	}
}
