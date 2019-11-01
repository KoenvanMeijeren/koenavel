<?php
declare(strict_types=1);


use App\Src\View\ProductionErrorView;
use App\Src\View\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function test_that_we_can_load_a_view()
    {
        ob_start();

        $this->assertInstanceOf(
            View::class,
            new View('index')
        );

        ob_end_clean();
    }

    public function test_that_we_cannot_load_a_view()
    {
        $this->expectException(Exception::class);

        new View('non_existing_view');
    }

    public function test_that_we_can_load_a_production_error_view()
    {
        ob_start();

        $test = new ProductionErrorView();
        $this->assertIsInt($test->handle());

        ob_end_clean();
    }
}
