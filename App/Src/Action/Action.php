<?php
declare(strict_types=1);


namespace App\Src\Action;


abstract class Action
{
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
     * @return bool
     */
    final public function execute(): bool
    {
        if ($this->authorize() && $this->validate()) {
            $this->handle();

            return true;
        }

        return false;
    }
}
