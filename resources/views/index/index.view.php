<h1>Index page</h1>

<h1>List of accounts</h1>
<ul>
    <?php foreach ($accounts ?? [] as $account): ?>
        <li>
            Naam: <?= $account->account_name ?? '' ?>
        </li>
    <?php endforeach; ?>
</ul>

