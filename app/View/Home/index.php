<main>
    <div id="container">
        <div class="row-login">
            <form action="<?=$BASEURL?>/login" method="POST" class="form login">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="">Sign In</h3>
                    <div class="wrap-icon">
                        <span><i class="bi bi-people-fill"></i></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="masukkan email anda" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="wrap-password">
                        <input type="password" class="form-control password" id="password" name="password" placeholder="masukkan email anda" required>
                        <div class="wrap-icon-form">
                            <span id="show" class="show">
                                <i class="bi bi-eye"></i>
                            </span>
                            <span id="hide" class="hide">
                                <i class="bi bi-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-dark" type="submit">Sign In</button>
                <div class="bottom mt-3">
                    <div class="remember">
                        <input type="checkbox" name="remember" id="remember" />
                        <label for="remember">Remember Me</label>
                    </div>
                    <a href="#" class="forgot link-dark text-decoration-none">Forgot Password</a>
                </div>
            </form>
        </div>

        <div class="row-register">
            <form action="<?=$BASEURL?>/register" method="POST" class="form login">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="">Sign Up</h3>
                    <div class="wrap-icon">
                        <span><i class="bi bi-person-add"></i></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="masukkan email anda" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="masukkan username anda" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="wrap-password">
                        <input type="password" class="form-control password" id="password" name="password" placeholder="masukkan password anda" required>
                        <div class="wrap-icon-form">
                            <span class="show">
                                <i class="bi bi-eye"></i>
                            </span>
                            <span class="hide">
                                <i class="bi bi-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Role</label>
                    <select id="level" class="form-select" name="level" required>
                        <option selected value="">Open this select menu</option>
                        <?php foreach($model["role"] as $role) : ?>
                            <option value="<?=$role["id"]?>"><?=$role["title"]?></option>
                        <?php endforeach; ?> 
                    </select>
                </div>
                <button class="btn btn-dark" type="submit">Sign Up</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="left">
                    <h2>Welcome to Register</h2>
                    <p>Already have an account?</p>
                    <button class="btn btn-light" clas id="sign-up">Sign In</button>
                </div>

                <div class="right">
                    <h2 class="">Welcome to Login</h2>
                    <p>Don't have account?</p>
                    <button class="btn btn-light" id="sign-in">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</main>