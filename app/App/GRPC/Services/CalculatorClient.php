<?php
// GENERATED CODE -- DO NOT EDIT!

namespace App\GRPC\Services;

/**
 */
class CalculatorClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \App\GRPC\Services\Sum $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Sum(\App\GRPC\Services\Sum $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/example.Calculator/Sum',
        $argument,
        ['\App\GRPC\Services\Result', 'decode'],
        $metadata, $options);
    }

}
