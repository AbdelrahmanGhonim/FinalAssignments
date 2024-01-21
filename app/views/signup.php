<?php
    include __DIR__ . '/header.php';
    ?>
    
 <!-- <div class="container">
        <h1>Signup Form</h1>

        <form action="/signup/create"  method="POST" id="signup-form">
            <div class="form-group">
            <input type="hidden" id="user-id" name="user-id" />
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="weight">Weight (kg):</label>
                <input type="number" class="form-control" id="weight" name="weight" required>
            </div>

            <div class="form-group">
                <label for="height">Height (cm):</label>
                <input type="number" class="form-control" id="height" name="height" required>
            </div>

            <div class="form-group">
                <label for="goal">Fitness Goal:</label>
                <select class="form-control" id="goal" name="goal" required>
                    <option value="Lose Weight">Lose Weight</option>
                    <option value="Maintain Weight">Maintain Weight</option>
                    <option value="Build Muscle">Build Muscle</option>
                </select>
            </div>

            <button type="submit" id="button"  class="btn btn-primary">submit</button>
        </form>
    </div>  -->
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center">Signup Form</h1>

            <form action="/signup/create" method="POST" id="signup-form">
                <div class="form-group">
                    <input type="hidden" id="user-id" name="user-id" />
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" class="form-control" id="age" name="age" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" class="form-control" id="weight" name="weight" required>
                </div>

                <div class="form-group">
                    <label for="height">Height (cm):</label>
                    <input type="number" class="form-control" id="height" name="height" required>
                </div>

                <div class="form-group">
                    <label for="goal">Fitness Goal:</label>
                    <select class="form-control" id="goal" name="goal" required>
                        <option value="Lose Weight">Lose Weight</option>
                        <option value="Maintain Weight">Maintain Weight</option>
                        <option value="Build Muscle">Build Muscle</option>
                    </select>
                </div>

                <button type="submit" id="button" class="btn btn-primary btn-block">Submit</button>
                 <?php
                    if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== "Guest") {
                       echo '<button type="button" class="btn btn-primary btn-block" id="delete-button">Delete</button>';
                        echo '<script src="js/user.js"></script>';
                    }
                ?>

            </form>
        </div>
    </div>
</div>

     <?php
    include __DIR__ . '/footer.php';
    ?> 

