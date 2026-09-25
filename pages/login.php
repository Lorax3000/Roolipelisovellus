<?php include "includes/header.php"; ?>

<body>

<div class="meow">

<h1>Log In</h1>

    <form method="POST" action="../index.php?page=loginUser">

        <div>
            <label>Username:</label>
            <input type="text" name="user_name" required>
        </div>

        <div>
            <label>Password:</label>
            <input type="password" name="user_pwd" required>
        </div>

        <button type="submit">Log In</button>

    </form>

    <p>
        Don't have an account?
        <a href="../index.php?page=signup">
            Sign Up
        </a>
    </p>

    <p>
        <a href="../index.php?page=dashboard">
            Back to Dashboard
        </a>
    </p>

</div>

</body>

<?php include "includes/footer.php"; ?>