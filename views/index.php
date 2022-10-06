<div class="container">
    <h2>Transfermate exam</h2>

    <div class="row pt-3">
        <div class="col">
            <div class="alert alert-info">
                If you don't see any records, please make sure you already created a database in postgres by importing the attached <code>transfermate.pgsql</code>, once you've done that just click "import XML data" <br />
                <a href="/import-data" class="btn btn-primary mt-2">Import XML data</a>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col">
            <form action="/" method="POST">
                <div class="my-3">
                    <label for="author_name" class="form-label">Search for author</label>
                    <input type="text" class="form-control w-25" id="author_name" aria-describedby="emailHelp" placeholder="Enter author name" name="author_name" value="<?= !empty($_POST['author_name']) ? $_POST['author_name'] : '' ?>">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                <?php if (!empty($_POST['author_name'])) : ?>
                    <a href="/" class="btn btn-danger">Clear</a>
                <?php endif; ?>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Author</th>
                        <th scope="col">Book</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $animation_delay = 2; ?>
                    <?php foreach ($result_data as $result) : ?>
                        <tr class="animate__animated animate__slideInLeft author_row">
                            <td><?= $result['author_name'] ?></td>
                            <td><?= $result['book_name'] ?></td>
                        </tr>
                        <?php
                            if ($animation_delay < 5) {
                                $animation_delay++;
                            }
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>