<h1 class="text-center">Your account</h1>

<table class="table w-50 mx-auto mt-5">
    <thead>
        <tr>
            <th scope="col" colspan="2" class="text-center">Informations</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Username</th>
            <td><?= htmlspecialchars($user['user_username']);?></td>
        </tr>
        <tr>
            <th scope="row">First name</th>
            <td><?= htmlspecialchars($user['user_fname']);?></td>
        </tr>
        <tr>
            <th scope="row">Last name</th>
            <td><?= htmlspecialchars($user['user_lname']);?></td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td><?= htmlspecialchars($user['user_email']);?></td>
        </tr>
    </tbody>
</table>

<div class="text-center">
    <a class="btn warning m-2" href="/user/update" role="button">Edit account informations</a>
    <a class="btn danger m-2" href="/user/delete" role="button">Delete my account</a>
</div>
