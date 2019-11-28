<?php
declare(strict_types=1);


namespace App\Src\Database;

use PDOException;

final class DB
{
    use BasicStatements;
    use SelectStatements;
    use WhereStatements;

    /**
     * The table to execute the query on.
     *
     * @var string
     */
    private static $table = '';

    /**
     * The query.
     *
     * @var string
     */
    private $query = '';

    /**
     * The values to bind to the query.
     *
     * @var mixed[]
     */
    private $values = [];

    /**
     * Set the table.
     *
     * @param string $table The table to execute the query on.
     *
     * @return DB
     */
    public static function table(string $table): DB
    {
        self::$table = $table;

        return new static();
    }

    /**
     * Execute a self written query.
     *
     * @param string $query The query to be executed.
     * @param string[] $values The values to bind to the query.
     *
     * @return DatabaseProcessor
     *
     * @throws PDOException
     */
    public static function query(
        string $query,
        array $values = []
    ): DatabaseProcessor {
        return new DatabaseProcessor($query, $values);
    }

    /**
     * Execute the prepared query.
     *
     * @return DatabaseProcessor
     *
     * @throws PDOException
     */
    public function execute(): DatabaseProcessor
    {
        $this->addHooksForInnerJoins();

        return new DatabaseProcessor($this->query, $this->values);
    }

    /**
     * Add a statement to the query.
     *
     * @param string $statement the statement to be added to the query
     *
     * @return DB
     */
    public function addStatement(string $statement): DB
    {
        if (strpos($this->query, 'WHERE') !== false) {
            $statement = preg_replace(
                '/\b(WHERE)\b/',
                "AND",
                $statement
            );
        }

        $this->query .= $statement;

        return $this;
    }

    /**
     * Add a statement to the query.
     *
     * @param string    $statement the statement to be added to the query
     * @param string[]  $values    the values to bind to the query
     *
     * @return DB
     */
    public function addStatementWithValues(string $statement, array $values): DB
    {
        if (strpos($this->query, 'WHERE') !== false) {
            $statement = replaceString(
                'WHERE',
                'AND',
                $statement
            );
        } elseif (preg_match_all('/\b(WHERE)\b/', $statement) !== false) {
            $statement = replaceAllExceptFirstString(
                'WHERE',
                'AND',
                $statement
            );
        }

        $this->query .= $statement;
        $this->addValues($values);

        return $this;
    }

    /**
     * Get the prepared query.
     *
     * @return string
     */
    public function getQuery(): string
    {
        $this->addHooksForInnerJoins();

        return $this->query;
    }

    /**
     * Add values. These values will be used when
     *             the query is going to be executed
     *
     * @param string[] $values The values to be added
     */
    public function addValues(array $values): void
    {
        $this->values += $values;
    }

    /**
     * Get the prepared values.
     *
     * @return string[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Count the inner joins in the query.
     *
     * @return int the number of full pattern matches (which might be zero)
     */
    private function countInnerJoinsInQuery(): int
    {
        return (int) preg_match_all('/\b(JOIN)\b/', $this->query);
    }

    /**
     * Add hooks for inner joins to the query. The hooks will only be added
     * when there are inner joins used.
     *
     * This function should be called when
     * the query is going to be executed or
     * you want to get the query.
     */
    private function addHooksForInnerJoins(): void
    {
        if ($this->countInnerJoinsInQuery() === 0) {
            return;
        }

        $hooks = '';
        for ($x = 0; $x < $this->countInnerJoinsInQuery(); $x++) {
            $hooks .= '(';
        }

        $this->query = (string) preg_replace(
            '/\b(FROM)\b/',
            "FROM {$hooks}",
            $this->query
        );

        if ($this->countInnerJoinsInQuery() === 1) {
            $this->query = (string) preg_replace(
                '/[()]/',
                '',
                $this->query
            );
        }
    }
}
