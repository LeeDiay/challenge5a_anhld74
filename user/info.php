<?php
session_start();
@include '../inc/config.php';
@include './check_user.php';
@include '../logout.php';
$username = $_SESSION['username'];
$select = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $select);
$info = mysqli_fetch_assoc($result);
?>

<?php
@include '../inc/user/header.php';
?>

<section class="p-5">
    <div class="container">
        <div>
            <div class="d-flex col-md justify-content-center">
                <div class="card bg-dark text-light" style="min-width: 40rem;">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <img src="<?php echo '../avatar_user/' . $info['avatar']; ?>" alt="Avatar" style="width: 200px; height: 200px; border-radius: 30%;">
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="text-end" style="min-width: 10rem;">
                                <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                    Username:
                                </h6>
                            </div>
                            <div class="text-end" style="min-width: 10rem;">
                                <span id="username"><?php echo $info['username']; ?></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="text-end" style="min-width: 10rem;">
                                <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                    Name:
                                </h6>
                            </div>
                            <div class="text-end" style="min-width: 10rem;">
                                <span id="name"><?php echo $info['name']; ?></span>
                                <input type="text" class="form-control" id="nameInput" style="display: none;" value="<?php echo $info['name']; ?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="text-end" style="min-width: 10rem;">
                                <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                    Email:
                                </h6>
                            </div>
                            <div class="text-end" style="min-width: 10rem;">
                                <span id="email"><?php echo $info['email']; ?></span>
                                <input type="email" class="form-control" id="emailInput" style="display: none;" value="<?php echo $info['email']; ?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="text-end" style="min-width: 10rem;">
                                <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                    Phone Number:
                                </h6>
                            </div>
                            <div class="text-end" style="min-width: 10rem;">
                                <span id="phone"><?php echo $info['phone']; ?></span>
                                <input type="text" class="form-control" id="phoneInput" style="display: none;" value="<?php echo $info['phone']; ?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="text-end" style="min-width: 10rem;">
                                <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                    Role:
                                </h6>
                            </div>
                            <div class="text-end" style="min-width: 10rem;">
                                <?php echo $info['type']; ?>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-primary float-end" id="editBtn">Edit</button>
                            <button class="btn btn-success float-end" id="saveBtn" style="display: none;">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('editBtn').addEventListener('click', function() {
        document.getElementById('editBtn').style.display = 'none';
        document.getElementById('saveBtn').style.display = 'block';

        document.getElementById('name').style.display = 'none';
        document.getElementById('email').style.display = 'none';
        document.getElementById('phone').style.display = 'none';

        document.getElementById('nameInput').style.display = 'block';
        document.getElementById('emailInput').style.display = 'block';
        document.getElementById('phoneInput').style.display = 'block';
    });

    document.getElementById('saveBtn').addEventListener('click', function() {
        var name = document.getElementById('nameInput').value;
        var email = document.getElementById('emailInput').value;
        var phone = document.getElementById('phoneInput').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_info.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                alert('Information updated successfully!');
                document.getElementById('name').textContent = name;
                document.getElementById('email').textContent = email;
                document.getElementById('phone').textContent = phone;

                document.getElementById('editBtn').style.display = 'block';
                document.getElementById('saveBtn').style.display = 'none';

                document.getElementById('name').style.display = 'inline';
                document.getElementById('email').style.display = 'inline';
                document.getElementById('phone').style.display = 'inline';

                document.getElementById('nameInput').style.display = 'none';
                document.getElementById('emailInput').style.display = 'none';
                document.getElementById('phoneInput').style.display = 'none';
            }
        };
        xhr.send('name=' + encodeURIComponent(name) + '&email=' + encodeURIComponent(email) + '&phone=' + encodeURIComponent(phone));
    });
</script>

<?php @include '../inc/footer.php'; ?>
