<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to Our Website</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="/forums/partials/_login.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Your Name</label>
                        <input type="text" name="loginuser" id="loginuser" id="disabledTextInput" class="form-control"
                            placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="loginpass" id="loginpass" class="form-control"
                            id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Log in</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>