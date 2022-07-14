<h1>Dashboard</h1>
<span>Welcome <a href="/admin/profile"> User </a></span>

<table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Birthday</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user): ?>
              <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['first_name'] ?></td>
                <td><?= $user['last_name'] ?></td>
                <td><?= $user['gender'] ?></td>
                <td><?= $user['birthday'] ?></td>
                <td>
                  <a href="/admin/profile/<?= $user['id']?>"><span class="badge text-bg-warning">Edit</span></a>
                  <a href="/admin/delete?id=<?= $user['id']?>"><span class="badge text-bg-danger">Delete</span></a>
                </td>
              </tr>
              <?php endforeach ?>
        </tbody>
      </table>