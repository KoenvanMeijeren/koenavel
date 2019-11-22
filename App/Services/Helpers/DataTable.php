<?php
declare(strict_types=1);


namespace App\Services\Helpers;

final class DataTable
{
    /**
     * @var string
     */
    private $table = '';

    /**
     * @var string
     */
    private $head = '';

    /**
     * @var string
     */
    private $rows = '';

    /**
     * @var string
     */
    private $footer = '';

    /**
     * @var string
     */
    private $ids = '';

    /**
     * @var string
     */
    private $classes = '';

    /**
     * The var to add the pieces to.
     *
     * @var string
     */
    private $var = 'table';

    public function addId(...$ids): void
    {
        $this->ids = implode(', ', $ids);
    }

    public function addClasses(...$classes): void
    {
        $this->classes = implode(', ', $classes);
    }

    public function addTableStart(): void
    {
        $this->add("<table>", $this->var);
    }

    public function addTableEnd(): void
    {
        $this->add("</table>", $this->var);
    }

    public function addHeadStart(): void
    {
        $this->add("<thead>", $this->var);
    }

    public function addHeadEnd(): void
    {
        $this->add("</thead>", $this->var);
    }

    public function addBodyStart(): void
    {
        $this->add("<tbody>", $this->var);
    }

    public function addBodyEnd(): void
    {
        $this->add("</tbody>", $this->var);
    }

    public function addFooterStart(): void
    {
        $this->add("<tfoot>", $this->var);
    }

    public function addFooterEnd(): void
    {
        $this->add("</tfoot>", $this->var);
    }

    public function addTrStart(): void
    {
        $this->add("<tr>", $this->var);
    }

    public function addTrEnd(): void
    {
        $this->add("</tr>", $this->var);
    }

    public function addThStart(): void
    {
        $this->add("<th>", $this->var);
    }

    public function addThEnd(): void
    {
        $this->add("</th>", $this->var);
    }

    public function addTdStart(): void
    {
        $this->add("<td>", $this->var);
    }

    public function addTdEnd(): void
    {
        $this->add("</td>", $this->var);
    }

    public function addHead(...$ths): void
    {
        $this->var = 'head';

        $this->addTrStart();

        array_walk($ths, function ($item) {
            $this->addThStart();
            $this->add($item, $this->var);
            $this->addThEnd();
        });

        $this->addTrEnd();
    }

    public function addRow(...$tds): void
    {
        $this->var = 'rows';

        $this->addTrStart();

        array_walk($tds, function ($item) {
            $this->addTdStart();
            $this->add($item, $this->var);
            $this->addTdEnd();
        });

        $this->addTrEnd();
    }

    public function addFooter(...$ths): void
    {
        $this->var = 'footer';

        $this->addTrStart();

        array_walk($ths, function ($item) {
            $this->addTdStart();
            $this->add($item, $this->var);
            $this->addTdEnd();
        });

        $this->addTrEnd();
    }

    public function get(): string
    {
        $this->var = 'table';

        $this->addClasses('table table-hover customTableStyle');
        $this->addTableStart();

        $this->addHeadStart();
        $this->add($this->head);
        $this->addHeadEnd();

        $this->addBodyStart();
        $this->add($this->rows);
        $this->addBodyEnd();

        $this->addFooterStart();
        $this->add($this->footer);
        $this->addFooterEnd();

        $this->addTableEnd();

        return $this->table;
    }

    private function add(string $piece, string $var = 'table'): void
    {
        if ($this->ids !== '') {
            $this->$var .= preg_replace(
                '/>/',
                " id='{$this->ids}' >",
                $piece
            );
        } elseif ($this->classes !== '') {
            $this->$var .= preg_replace(
                '/>/',
                " class='{$this->classes}' >",
                $piece
            );
        } else {
            $this->$var .= $piece;
        }

        $this->reset();
    }

    public function reset(): void
    {
        $this->ids = '';
        $this->classes = '';
    }
}
