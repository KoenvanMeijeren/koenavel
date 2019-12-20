<?php
declare(strict_types=1);


namespace App\Src\Action;

abstract class FileAction
{
    protected array $acceptedOrigins = [
        'http://localhost'
    ];

    /**
     * Handle the request and execute the action.
     *
     * @return void
     */
    abstract protected function handle(): void;

    /**
     * Authorize the request for the action.
     *
     * @return bool
     */
    abstract protected function authorize(): bool;

    /**
     * Validate the given input.
     *
     * @return bool
     */
    abstract protected function validate(): bool;

    /**
     * Execute the validation and handle the request.
     *
     * @return void
     */
    final public function execute(): void
    {
        if ($this->authorize() && $this->validate()) {
            $this->handle();

            return;
        }
    }
}
