<?php
include __DIR__ . '/header.php';
?>

<div class="background-image">
    <div class="text-Intro">
        <h1>Welcome to My Website</h1>
        <p>This is a message about the website.</p>
    </div>
</div>

<div class="card-Intro">
    <p>Welcome to the heart of your fitness transformation! Our Progress Tracker is your personalized dashboard to
        monitor and celebrate every step of your journey towards a healthier, stronger, and more vibrant you. This
        dynamic tool is designed to keep you motivated, accountable, and in control</p>
</div>

<?php if (isset($_SESSION["user_name"])): ?>
    <div class="workout">
        <div class="workouts-list">
            <h3>Workout</h3>
            <ul id="addedWorkouts"></ul>
        </div>
        <button id="addWorkoutBtn" type="button" class="btn btn-info add-workout">Add Workout</button>

    </div>

    <div id="popupForm" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopupForm()">&times;</span>
            <h2 class="addworkouttxt">Add Workout</h2>
            <form id="workoutForm">
                <label id="userIdLabel" style="display: none;">
                    <?php echo $_SESSION["id"]; ?>
                </label>
                <label for="exerciseName">Exercise:</label>
                <input type="text" id="exerciseName" name="exerciseName" placeholder="Enter exercise" required>
                <label for="duration">Duration:</label>
                <input type="number" id="duration" name="duration" placeholder="Duration" required step="1">
                <button id="adding-btn" type="button submit" class="btn btn-info">Add</button>
            </form>
        </div>
    </div>



    <div class="container">
        <div class="card wide-card">
            <div class="card-body">
                <h5 class="card-title">Calories</h5>
                <div class="session-info">
                    <p class="session-goal">
                        Goal:
                        <?php echo $_SESSION['goal']; ?>
                    </p>
                    <p class="session-weight">
                        Weight:
                        <?php echo $_SESSION['weight']; ?>
                    </p>
                </div>
                <p class="card-text">
                    Remaining = Goal - Food + Exercise
                </p>
                <div class="circle">
                    <p class="caloriesIntake">
                        <?php echo $_SESSION['caloriesIntake']; ?>
                    </p>
                </div>
            </div>
        </div>



        <div id="searchPopupf" class="popup-food">
            <div class="popup-foodcontent">
                <span class="closef">&times;</span>
                <!-- <h4 class="table-header">This calculation based on 100g per each</h4> -->
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Enter food name">
                    <button id="searchButton" class="btn btn-success">Search</button>
                </div>
                <div class="results-container">
                    <ul id="recipeList" class="scrollable-list"></ul>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="button-container">
                <button id="openPopupButtonf" class="btn btn-success">Add Food</button>
                <button id="editButton" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>

                <table class="table" id="nutritionTable">
                    <thead>
                        <tr>
                        <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>



    <script src="js/nutritionFact.js"></script>

<?php else: ?>
    <div class="container">
        <div class="card wide-card">
            <div class="card-body2">
                <h5 class="card-title">
                    Welcome to Your Fitness Progress Tracker
                </h5>
                <p class="p2">
                    Embark on your journey to a healthier you! Set your input your
                    <span class="word-highlighted">calories</span>, and track your
                    <span class="word-highlighted">weight</span> to kickstart personalized progress tracking. Get ready for
                    a curated list of foods designed to support your aspirations. Your dedication is the key to turning
                    goals into achievements. Let's make every step count.
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
include __DIR__ . '/footer.php';
?>