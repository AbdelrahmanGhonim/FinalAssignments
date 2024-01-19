<?php
    include __DIR__ . '/header.php';
    ?>

<!-- Momen mmkn hna t3mal check if (isset($SESSION_user_name)) fa lw 7d 3mal login w tmam t3mal display ll code dah lw la mmkn t3mal zay image 3daya kda w text fel nos zay explanation ll page di hykon fiha eh w kda. ana h3mal al content tab3an bs ana b2olak 3la al fekra bas w lw ynfa3 t3mal add l kza sora kda b7as al design ykon 7lw w ana hb2a a8iar fal swar b3den w al content -->

<main class="container">
    <h1>Progress Tracker</h1>
    <?php if (isset($SESSION_user_name)) { ?>
    <section class="card fa-wide-card">
        <div class="fa-card-body">
            <h2 class="card-title">Calories</h2>
            <div class="fa-session-info">
                <p class="session-goal">
                    Goal: <?php echo $_SESSION['goal']; ?>
                </p>
                <p class="session-weight">
                    Weight: <?php echo $_SESSION['weight']; ?>
                </p>
            </div>
            <p class="fa-card-text">
                Remaining = Goal - Food + Exercise
            </p>
            <div class="fa-circle">
                <p class="fa-caloriesIntake">
                    <?php echo $_SESSION['caloriesIntake']; ?>
                </p>
            </div>
        </div>
    </section>
    <p>* This calculation based on 100g per each</p>
    <table class="table" id="nutritionTable">
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <?php } else { ?>
    <section class="card fa-wide-card p-0">
        <img src="https://uploads-ssl.webflow.com/612c9fe71d22d5586d8b2291/626d18cdabfcc7bf43e2a07b_Training%20als%20Anfa%CC%88nger.jpg" />
        <div class="fa-wide-card-content">
            <h2>Calories</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates vel magnam iste alias quaerat soluta fuga error facilis facere quo rem adipisci, odio saepe recusandae exercitationem distinctio aperiam laborum. Debitis?</p>
        </div>
    </section>

    <?php } ?>
</main>



<script src="js/nutritionFact.js"></script>

<?php
    include __DIR__ . '/footer.php';
?>