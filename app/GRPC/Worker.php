<?php

declare(strict_types=1);

namespace App\GRPC;

use App\GRPC\Services\CalculatorClient;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use InvalidArgumentException;
use Spiral\Goridge\RelayInterface;
use Spiral\Goridge\StreamRelay;
use Spiral\GRPC\Server;
use Spiral\RoadRunner\Worker as SpiralWorker;

/**
 * Class Worker
 * @package App\GRPC
 */
class Worker
{
    public function start()
    {
        $server = $this->createServer();
        $server->registerService(CalculatorClient::class, new CalculatorClient());
        $server->serve($this->createSpiralWorker($this->createStreamRelay()));
    }

    protected function createSpiralWorker(RelayInterface $relay): SpiralWorker
    {
        return new SpiralWorker($relay);
    }

    protected function createStreamRelay($in = \STDIN, $out = \STDOUT): RelayInterface
    {
        return new StreamRelay($in, $out);
    }

    protected function createServer(): Server
    {
        return new Server();
    }

    protected function createApplication(string $base_path): ApplicationContract
    {
        $path = implode(
            DIRECTORY_SEPARATOR,
            [rtrim($base_path, DIRECTORY_SEPARATOR), 'bootstrap', 'app.php']
        );

        if (!is_file($path)) {
            throw new InvalidArgumentException("Application bootstrap file was not found in [{$path}]");
        }

        return require $path;
    }
}
