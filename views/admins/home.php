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
            <td><?= htmlspecialchars($admin['admin_username']);?></td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td><?= htmlspecialchars($admin['admin_email']);?></td>
        </tr>
    </tbody>
</table>

<div class="text-center">
    <a class="btn warning" href="/admin/update?id=<?= htmlspecialchars($admin['admin_id']) ?>" role="button">Edit account informations</a>
    <a class="btn danger" href="/admin/delete?id=<?= htmlspecialchars($admin['admin_id']) ?>" role="button">Delete my account</a>
</div>
