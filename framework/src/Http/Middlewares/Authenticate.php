<?php

namespace Neitsab\Framework\Http\Middlewares;

use Neitsab\Framework\Auth\SessionAuthentification;
use Neitsab\Framework\Http\Request;
use Neitsab\Framework\Http\Response\Response;
use Neitsab\Framework\Http\Middlewares\Contracts\MiddlewareInterface;
use Neitsab\Framework\Http\Middlewares\Contracts\RequestHandlerInterface;
use Neitsab\Framework\Session\Session;
use Neitsab\Framework\Session\SessionInterface;

class Authenticate implements MiddlewareInterface
{
	private bool $authenticated;

	public function __construct(SessionInterface $session)
	{
		$this->authenticated = $session->has(Session::AUTH_KEY);
	}

	public function process(Request $request, RequestHandlerInterface $handler): Response
	{
		if (!$this->authenticated)
			return new Response('Unauthorized', 401);

		return $handler->handle($request);
	}
}
