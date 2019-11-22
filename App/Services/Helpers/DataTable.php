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
     * @var string
     */
    private $toggle = '';

    /**
     * @var string
     */
    private $target = '';

    /**
     * @var string
     */
    private $colspan = '';

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

    public function addDataToggle(string $name) : void
    {
        $this->toggle = $name;
    }

    public function addDataTarget(string $name) : void
    {
        $this->target = $name;
    }

    public function addColspan(string $number) : void
    {
        $this->colspan = $number;
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

    public function addCollapsibleRow(
        string $target,
        array $firstTds,
        string $collapsible
    ): void {
        $this->var = 'rows';
        $colspan = preg_match_all('/<\/th>/', $this->head);

        $this->addDataToggle('collapse');
        $this->addDataTarget($target);
        $this->addClasses('accordion-toggle');

        $this->addTrStart();
        array_walk($firstTds, function ($item) {
            $this->addTdStart();
            $this->add($item, $this->var);
            $this->addTdEnd();
        });
        $this->addTrEnd();

        $this->addTrStart();
        $this->addClasses('hiddenRow');
        $this->addColspan((string) $colspan);
        $this->addTdStart();
        $this->add($collapsible, $this->var);
        $this->addTdEnd();

        for ($x = 1; $x < $colspan; ++$x) {
            $this->addClasses('d-none');
            $this->addTdStart();
            $this->addTdEnd();
        }

        $this->addTrEnd();
    }

    public function addFooter(...$ths): void
    {
        $this->var = 'footer';

        $this->addTrStart();

        array_walk($ths, function ($item) {
            $this->addThStart();
            $this->add($item, $this->var);
            $this->addThEnd();
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
        $string = $piece;

        if ($this->ids !== '') {
            $string = preg_replace(
                '/>/',
                " id='{$this->ids}' >",
                $string
            );
        }

        if ($this->classes !== '') {
            $string = preg_replace(
                '/>/',
                " class='{$this->classes}' >",
                $string
            );
        }

        if ($this->toggle !== '') {
            $string = preg_replace(
                '/>/',
                " data-toggle='{$this->toggle}' >",
                $string
            );
        }

        if ($this->target !== '') {
            $string = preg_replace(
                '/>/',
                " data-target='{$this->target}' >",
                $string
            );
        }

        if ($this->colspan !== '') {
            $string = preg_replace(
                '/>/',
                " colspan='{$this->colspan}' >",
                $string
            );
        }

        $this->$var .= $string;
        $this->reset();
    }

    public function reset(): void
    {
        $this->ids = '';
        $this->classes = '';
        $this->toggle = '';
        $this->target = '';
        $this->colspan = '';
    }
}
