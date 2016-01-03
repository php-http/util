<?php

namespace spec\Http\Utils\StreamFactory;

use GuzzleHttp\Psr7\Stream;
use PhpSpec\ObjectBehavior;
use spec\Http\Utils\StreamFactoryBehavior;

class GuzzleStreamFactorySpec extends ObjectBehavior
{
    use StreamFactoryBehavior;

    public function it_is_initializable()
    {
        $this->shouldHaveType('Http\Utils\StreamFactory\GuzzleStreamFactory');
    }

    public function it_creates_a_stream_from_stream()
    {
        $this->createStream(new Stream(fopen('php://memory', 'rw')))
            ->shouldHaveType('Psr\Http\Message\StreamInterface');
    }
}
