<?php

namespace spec\Http\Utils;

use Http\Client\HttpClient;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BatchClientSpec extends ObjectBehavior
{
    function let(HttpClient $client)
    {
        $this->beAnInstanceOf('Http\Utils\BatchClient', [$client]);
    }

    function it_send_multiple_request_using_send_request(HttpClient $client, RequestInterface $request1, RequestInterface $request2, ResponseInterface $response1, ResponseInterface $response2)
    {
        $client->sendRequest($request1)->willReturn($response1);
        $client->sendRequest($request2)->willReturn($response2);

        $this->sendRequests([$request1, $request2])->shouldReturnAnInstanceOf('Http\Utils\BatchResult');
    }

    function it_throw_batch_exception_if_one_or_more_request_failed(HttpClient $client, RequestInterface $request1, RequestInterface $request2, ResponseInterface $response)
    {
        $client->sendRequest($request1)->willReturn($response);
        $client->sendRequest($request2)->willThrow('Http\Client\Exception\HttpException');

        $this->shouldThrow('Http\Utils\Exception\BatchException')->duringSendRequests([$request1, $request2]);
    }
}
