<?php
declare(strict_types=1);


namespace App\Services\Helpers;

use App\Src\Exceptions\Table\InvalidTableStructureException;

final class DataTable
{
    /**
     * The table to be build.
     *
     * @var string
     */
    private $table;

    /**
     * @param string $id the id of the table
     */
    public function __construct(string $id)
    {
        $this->addTableContent(
            "<table id='".$id."' class='ui table-hover celled table' style='width:100%'>"
        );
    }

    /**
     * Add a head to the table.
     *
     * @param string[] ...$heads the head of the table
     *
     * @throws InvalidTableStructureException
     */
    public function addHead(...$heads): void
    {
        if (strstr($this->table, 'thead')) {
            throw new InvalidTableStructureException(
                'The head is already added to table.'
            );
        }

        $heads = '<th>' . implode('</th><th>', $heads) . '</th>';
        $this->addTableContent(
            "<thead><tr>{$heads}</tr></thead>"
        );
    }

    /**
     * Add a row to the table.
     *
     * @param string[] ...$row the row to be added.
     */
    public function addRow(...$row): void
    {
        if (!strstr($this->table, 'tbody')) {
            $this->addTableContent('<tbody>');
        }

        $row = '<td>' . implode('</td><td>', $row) . '</td>';
        $this->addTableContent(
            "<tr>{$row}</tr>"
        );
    }

    /**
     * Add a footer to the table.
     *
     * @param string[] ...$footer the footer of the table
     *
     * @throws InvalidTableStructureException
     */
    public function addFooter(...$footer): void
    {
        if (strstr($this->table, 'tfoot')) {
            throw new InvalidTableStructureException(
                'The footer is already added to table.'
            );
        }

        $heads = '<th>' . implode('</th><th>', $footer) . '</th>';
        $this->addTableContent(
            "<tfoot><tr>{$heads}</tr></tfoot>"
        );
    }

    /**
     * Get the built table.
     *
     * @return string
     */
    public function getTable(): string
    {
        $this->addTableContent(
            "</tbody></table>"
        );

        return $this->table;
    }

    private function addTableContent(string $table): void
    {
        $this->table .= $table;
    }
}
