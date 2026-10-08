<?php include "includes/header.php"; ?>

<main class="help-page">

<h1>You found the help page</h1>
<p class="help-intro">Here is some hopefully helpful info about this site.</p>

<a href="index.php?page=dashboard" class="help-back-button">
    ← BACK TO DASHBOARD
</a>

<section>

    <h2>Account</h2>

    <p>To create an account you can press <a href="index.php?page=signup" id="help-links">this link</a> and then make yourself a username, put in your email and create a password ( do NOT forget it since there is NO way to change it later ;) ) or simply going back if you aren't already logged in, to log in press <a href="index.php?page=login" id ="help-links">this link</a>.</p>

</section>

<section>

    <h2>Characters</h2>

    <h3>Create a character</h3>

    <p>Creating a character is easy, first make sure you're logged in, then click <a href="index.php?page=dashboard" id="help-links">this link</a> then find the button that says "Create Character" and click it, at last give it a cool name ( or don't ) select a class and race ( doesn't affect gameplay ) and click the Create button. That's it for that but keep in mind the three options displayed cannot be changed later so make sure those are the ones you want.</p>

    <h3>Edit or delete a chracter</h3>

    <p>To edit a character you first need a character, if you don't have one yet follow the instructions above. So now, when you have a character it will be displayed in the <a href="index.php?page=dashboard" id="help-links">dashboard</a> bellow each character you have is the button to view your chracter, in their at the bottom is the edit chracter button, click it and change whtever you want. Down there is the button to delete a character so that is also easy to do, and no you cannot get your character back if you delete it by accident.</p>

</section>

<section>

    <h2>Campaigns</h2>

    <h3>Creating a campaign</h3>

    <p>To create a campaign first go to your <a href="index.php?page=dashboard" id="help-links">dashboard</a> then click campaigns or <a href="index.php?page=campaigns" id="help-links">this link</a> after that you can click on Create Campaign, enter your campaigns name, a description for the campaign, and as for the status it is recommended to leave it as is, then click create.</p>

    <h3>Editing or deleting a campaign</h3>

    <p>To edit or delete a campaign go to the <a href="index.php?page=campaigns" id="help-links">campaigns page</a> and find your campaign, then click on the edit or delete button according to what you need, for editing you can edit the campaigns name, descriptiion and status, when done click Save changes. For deleting just click the delete button.</p>

    <h3>Statuses and their meaning</h3>

    <p>There are 4 different statuses a campaign can have:</p>
    <ol>
        <li>Active: The campaign is ongoing.</li>
        <li>Paused: The campaign is on pause.</li>
        <li>Finished: The campaign has finished.</li>
        <li>Archived: The campaign has been archived.</li>
    </ol>

    <h3>Invitations</h3>

    <p>You can invite other users to your campaign ( this does nothing other than look cool ), to invite other users make sure you have created a campaign, after open the campaign using the "open" button then in the "Players" section there is a dropdown with every single user ( I know, it is too convoluted ), click the one you want to invite and click "Add Player", they will get an invitation on their <a href="index.php?page=invitations" id="help-links">invitations page</a>, as soon as they click it their status will change from "Pending" to "Alive" meaning that they have accepted the invitation. Sadly I'm lazy so there is no way do reject an invitation.</p>

    <h3>Adding characters to a campaign</h3>

    <p>Adding characters to a campaign is easy, go to your <a href="index.php?page=campaigns" id="help-links">campaigns page</a> click open on a campaign you have created, find the "Players" section and click on the "Select Character" dropdown, all your characters will be displayed there, click the one you like the most I guess and the click the "Add Character" button, now your character will be displayed a little bellow on the "Caharacters" section.</p>

    <h3>Removing characters from a campaign</h3>

    <p>You can't ( I'm too lazy ).</p>

</section>

<section>

    <h2>Game</h2>
    
    <h3>Starting a game</h3>

    <p>You can start a game by going to a campaign you own, adding at least one character and clicking "Start Game".</p>

    <h3>How to play</h3>

    <p>Simply said, you click one of two buttons, either Attack or Defend, the Attack button will attack the enemy and deal damage, the Defend button will halve the damage an enemy may deal, once the enemy is defeated you will gain some xp ( keep in mind your character will keep their current level but if you close the site and come back the xp will be lost ), when leveling up your character will regain lost health and get +5 to their max health ( after level 5 no stats will be added ).</p>

</section>

</main>

<?php include "includes/footer.php"; ?>