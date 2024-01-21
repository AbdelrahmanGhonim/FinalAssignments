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
        <p>Welcome to the heart of your fitness transformation! Our Progress Tracker is your personalized dashboard to monitor and celebrate every step of your journey towards a healthier, stronger, and more vibrant you. This dynamic tool is designed to keep you motivated, accountable, and in control</p>
    </div>

    <?php if (isset($_SESSION["user_name"])) : ?>

    <div class="container">        
        <div class="card wide-card">
            <div class="card-body">
                <h5 class="card-title">Calories</h5>
                <div class="session-info">
                    <p class="session-goal">
                        Goal: <?php echo $_SESSION['goal']; ?>
                    </p>
                    <p class="session-weight">
                        Weight: <?php echo $_SESSION['weight']; ?>
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
             <div class="row">
                <!-- First Column -->
                    <div class="col-md-6">
                        <img class="image1 img-fluid rounded" src="img/progressTracker/image2.jpg" alt="Image">
                        <p class="text-image1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit fugiat odit pariatur soluta repellendus nostrum unde perspiciatis voluptatem non, ratione praesentium in repellat, perferendis optio fugit, libero quasi animi commodi! Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit fugiat odit pariatur soluta repellendus nostrum unde perspiciatis voluptatem non, ratione praesentium in repellat, perferendis optio fugit, libero quasi animi commodi.</p>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-6">
                        <p class="text-image2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit fugiat odit pariatur soluta repellendus nostrum unde perspiciatis voluptatem non, ratione praesentium in repellat, perferendis optio fugit, libero quasi animi commodi! Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit fugiat odit pariatur soluta repellendus nostrum unde perspiciatis voluptatem non, ratione praesentium in repellat, perferendis optio fugit, libero quasi animi commodi.</p>
                        <img class="image2 img-fluid rounded" src="img/progressTracker/image1.jpg" alt="Image">
                    </div>
            </div>

            
            <h4 class="table-header">This calculation based on 100g per each</h4>

                <table class="table" id="nutritionTable">
                    <thead>
                        <tr>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>       
    </div>
<script src="js/nutritionFact.js"></script>

<?php else : ?>
    <div class="container">        
        <div class="card wide-card">
            <div class="card-body2">
                <h5 class="card-title">
                    Welcome to Your Fitness Progress Tracker
                </h5>
                <p class="p2"> 
                    Embark on your journey to a healthier you! Set your input your 
                    <span class="word-highlighted">calories</span>, and track your 
                    <span class="word-highlighted">weight</span> to kickstart personalized progress tracking. Get ready for a curated list of foods designed to support your aspirations. Your dedication is the key to turning goals into achievements. Let's make every step count.
                </p>
            </div>
        </div>
    </div>
    <?php endif; ?>

<?php
    include __DIR__ . '/footer.php';
?>