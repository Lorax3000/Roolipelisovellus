<?php include "includes/header.php"; ?>

<body>

<div class="meow">
<h1>Sign Up</h1>

<form method="POST" action="../index.php?page=signupUser">

    <div>
        <label>Username:</label>
        <input type="text" name="user_name" required>
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="user_email" required>
    </div>

    <div>
        <label>Password:</label>
        <input type="password" name="user_pwd" required>
    </div>

    <button type="submit">Sign Up</button>

</form>

<p>
    Already have an account?
    <a href="../index.php?page=login">
        Log In
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