<div class="container">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="/index.php">
                <img src="/assets/images/Varumox V.png" alt="" height="25">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" style="color: var(--color-text)">Plugins</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <?php
echo '<p>access token:</p>';
echo '<p><code>' . $accessToken . '</code></p>';
echo '<br />';

if ($accessToken !="") {
    echo '<p>Logged in!</p>';
    } else {
        // Not logged in
        echo <a href="https://github.com/login/oauth/authorize?client_id=ebdf3797bfd3bae04bda" type="button" class="btn btn-outline-warning" style="margin-left: 10px">Login with Github</a>;
    }
            </div>
        </div>
    </nav>
</div>