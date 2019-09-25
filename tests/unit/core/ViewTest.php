<?php
declare(strict_types=1);


use App\services\core\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function test_that_we_cannot_load_a_view()
    {
        $this->expectException(Exception::class);

        new View('non_existing_view');
    }
}
