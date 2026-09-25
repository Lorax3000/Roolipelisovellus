<?php include "includes/header.php"; ?>

<div class="character_creation_form">
    <form method="POST" action="../index.php?page=createCampaign">
        <label for="character_name">Campaign Name:</label>
        <input name="character_name" type="text" placeholder="...">

        <label for="campaign_desc">Campaign Description:</label>
        <textarea name="campaign_desc" id="campaign_desc" cols="30" rows="10"></textarea>

        <button type="submit">Create</button>
        <button type="reset">Reset</button>
    </form>

<p>
    <a href="../index.php?page=dashboard">
        Back to Dashboard
    </a>
</p>

</div>

<?php include "includes/footer.php"; ?>