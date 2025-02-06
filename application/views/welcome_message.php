<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>User Management</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
	<div class="container">
		<h1 class="text-center fw-bold p-5">User Management</h1>
		<div class="d-flex gap-5 pb-5">
			<input type="text" class="form-control" id="username" placeholder="Username">
			<input type="text" class="form-control" id="firstname" placeholder="First Name">
			<input type="text" class="form-control" id="lastname" placeholder="Last Name">
			<input type="text" class="form-control" id="email" placeholder="E-mail">
			<input id="submit_data" type="button" class="btn btn-primary" value="Save">
		</div>
		<table class="table">
			<thead class="fw-bold">
				<td>ID</td>
				<td>Username</td>
				<td>First Name</td>
				<td>Last Name</td>
				<td>E-mail</td>
				<td>Action</td>
			</thead>
			<tbody>
				<?php foreach ($info as $data): ?>
					<tr>
						<td><?= $data->id ?></td>
						<td><?= $data->username ?></td>
						<td><?= $data->firstname ?></td>
						<td><?= $data->lastname ?></td>
						<td><?= $data->email ?></td>
						<td>
							<div class="d-flex gap-2">
								<button id="edit" data-id="<?= $data->id ?>" data-user="<?= $data->username ?>"
									data-action="Edit" class="btn btn-warning">Edit</button>
								<button id="delete" data-id="<?= $data->id ?>" class="btn btn-danger">Delete</button>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
	var id = 0;
	var action = '';

	$(document).ready(function () {

		$(document).on('click', '#submit_data', function () {
			var username = $('#username').val();
			var firstname = $('#firstname').val();
			var lastname = $('#lastname').val();
			var email = $('#email').val();


			if (action == 'Edit') {
				$.ajax({
					url: "<?= base_url('welcome/update_data'); ?>",
					method: "POST",
					data: {
						username: username,
						firstname: firstname,
						lastname: lastname,
						email: email,
					},
					dataType: "json",
					success: function (data) {
						if (data.error != '') {
							alert(data.error);
						} else {
							alert(data.error);
							location.reload();
						}
					}
				})

			} else {
				$.ajax({
					url: "<?= base_url('welcome/save_data'); ?>",
					method: "POST",
					data: {
						username: username,
						firstname: firstname,
						lastname: lastname,
						email: email,
					},
					dataType: "json",
					success: function (data) {
						if (data.error != '') {
							alert(data.error);
						} else {
							alert(data.error);
							location.reload();
						}
					}
				})
			}



		});

		$(document).on('click', '#edit', function () {
			id = $(this).data('id');
			action = $(this).data('action');

			$.ajax({
				url: '<?= base_url('welcome/get_record') ?>/' + id,
				method: 'GET',
				success: function (data) {
					var user = JSON.parse(data);
					$('#username').val(user.username);
					$('#firstname').val(user.firstname);
					$('#lastname').val(user.lastname);
					$('#email').val(user.email);
				}
			});
		});
	});
</script>

</html>