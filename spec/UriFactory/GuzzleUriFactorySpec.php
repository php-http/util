<?php

namespace spec\Http\Client\Utils\UriFactory;

use Psr\Http\Message\UriInterface;
use PhpSpec\ObjectBehavior;

class GuzzleUriFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Http\Client\Utils\UriFactory\GuzzleUriFactory');
    }

    function it_is_a_uri_factory()
    {
        $this->shouldImplement('Http\Message\UriFactory');
    }

    function it_creates_a_uri_from_string()
    {
        $this->createUri('http://php-http.org')->shouldHaveType('Psr\Http\Message\UriInterface');
    }

    function it_creates_a_uri_from_uri(UriInterface $uri)
    {
        $this->createUri($uri)->shouldReturn($uri);
    }

    function it_throws_an_exception_when_uri_is_invalid()
    {
        $this->shouldThrow('InvalidArgumentException')->duringCreateUri(null);
    }
}
