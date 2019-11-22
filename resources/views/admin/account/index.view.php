<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Accounts bewerken
                </h4>
            </div>
            <div class="card-body w-100">
                <table class="table table-hover customTableStyle">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr data-toggle="collapse" data-target="#demo2"
                        class="accordion-toggle">
                        <td>2</td>
                        <td>12 Jan 2018</td>
                        <td>Good</td>
                        <td>$11.00</td>
                        <td> -</td>
                        <td>$161.00</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="hiddenRow">
                            <div id="demo2" class="accordian-body collapse p-3">
                                <p>No : <span>2</span></p>
                                <p>Date : <span>12 Jan 2018</span></p>
                                <p>Description : <span>Good</span></p>
                                <p>Credit : <span>$150.00</span></p>
                                <p>Debit : <span></span></p>
                                <p>Balance : <span>$150.00</span></p>
                                <p>
                                    "Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                    Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip
                                    ex ea commodo consequat. Duis aute irure
                                    dolor in reprehenderit in voluptate velit
                                    esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt
                                    mollit anim id est laborum."
                                </p>
                            </div>
                        </td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Accounts bewerken
                </h4>
            </div>
            <div class="card-body w-100">
                <?= $accounts ?? 'niks gevonden' ?>
            </div>
        </div>
    </div>
</div>
