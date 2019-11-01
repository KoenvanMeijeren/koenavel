<?php
declare(strict_types=1);


class RedirectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function test_that_we_can_get_the_redirect_response()
    {
        new \App\Services\Response\Redirect('/test');

        $this->assertContains(
            'Location: /test', xdebug_get_headers()
        );
    }
}
