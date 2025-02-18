<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use React\EventLoop\Factory;
use React\Socket\Server as SocketServer;
use React\Socket\ConnectionInterface;
use App\Services\DeviceDataService;

class ToraiSocketServer extends Command
{
    protected $signature = 'socket:torai';
    protected $description = 'Start the Torai device socket server';

    protected $deviceDataService;

    public function __construct(DeviceDataService $deviceDataService)
    {
        parent::__construct();
        $this->deviceDataService = $deviceDataService;
    }

    public function handle()
    {
        set_time_limit(0);

        $host = '45.79.121.28'; 
        $port = 9025;           

        $loop = Factory::create();

        $socketServer = new SocketServer("$host:$port", $loop);  

        $this->info("Torai Server listening on port $port");

        $socketServer->on('connection', function (ConnectionInterface $conn) {
            $this->info("Client connected: {$conn->getRemoteAddress()}");

            $conn->on('data', function ($data) use ($conn) {
                $this->handleClientData($data);
                $conn->write("Data received\n");
            });

            $conn->on('close', function () use ($conn) {
                $this->info("Client disconnected: {$conn->getRemoteAddress()}");
            });
        });

        $loop->run();
    }

    protected function handleClientData($data)
    {
        $this->info("Received data: $data");
        $response = $this->deviceDataService->handleDeviceData($data);

        // $this->info("Response: " . json_encode($response));
    }
}
