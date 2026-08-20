<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\HttpHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\LogRecord;

class CoralogixLogger
{
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('coralogix');

        $privateKey = env('CORALOGIX_PRIVATE_KEY');
        $appName = env('CORALOGIX_APP_NAME', 'portal-berita');
        $subsystem = env('CORALOGIX_SUBSYSTEM_NAME', 'local');
        
        // Endpoint REST API Coralogix AP3 (Jakarta)
        $url = 'https://ingress.ap3.coralogix.com/api/v1/logs';

        $handler = new HttpHandler($url, Logger::DEBUG, true);

        // Header wajib Coralogix
        $handler->setHeaders([
            'Content-Type: application/json',
            'private_key: ' . $privateKey,
        ]);

        // Formatter payload JSON
        $handler->setFormatter(new class($appName, $subsystem) extends LineFormatter {
            private $appName;
            private $subsystem;

            public function __construct($appName, $subsystem)
            {
                parent::__construct();
                $this->appName = $appName;
                $this->subsystem = $subsystem;
            }

            public function format(LogRecord $record): string
            {
                $payload = [
                    'applicationName' => $this->appName,
                    'subsystemName'   => $this->subsystem,
                    'timestamp'       => (int) (microtime(true) * 1000),
                    'severity'        => $this->getSeverityLevel($record->level->value),
                    'text'            => json_encode([
                        'message' => $record->message,
                        'context' => $record->context,
                        'extra'   => $record->extra,
                    ]),
                ];

                return json_encode([$payload]);
            }

            private function getSeverityLevel(int $level): int
            {
                return match (true) {
                    $level <= 100 => 1, // DEBUG
                    $level <= 200 => 3, // INFO
                    $level <= 300 => 4, // WARN
                    $level <= 400 => 5, // ERROR
                    default       => 6, // CRITICAL
                };
            }
        });

        $logger->pushHandler($handler);

        return $logger;
    }
}