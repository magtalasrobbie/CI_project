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

<body class="bg-light">
	<div class="container">
		<h1 class="text-center fw-bold p-4">User Management</h1>
		<div class="d-flex justify-content-center">
			<div class="card px-3 shadow mb-3">
				<form>
					<div class="d-flex justify-content-center flex-wrap gap-2 pb-2">
						<div class="py-2">
							<label class="fw-bold" for="username">Username</label>
							<input type="text" class="form-control form-control-sm" id="username"
								placeholder="e.g. juandelacruz" required>
						</div>
						<div class="py-2">
							<label class="fw-bold" for="email">E-mail</label>
							<input type="email" class="form-control form-control-sm" id="email"
								placeholder="e.g. example@gmail.com" required>
						</div>
						<div class="py-2">
							<label class="fw-bold" for="firstname">First Name</label>
							<input type="text" class="form-control form-control-sm" id="firstname"
								placeholder="e.g. Juan" required>
						</div>
						<div class="py-2">
							<label class="fw-bold" for="lastname">Last Name</label>
							<input type="text" class="form-control form-control-sm" id="lastname"
								placeholder="e.g. Dela Cruz" required>
						</div>
						<div class="py-2 align-self-end">
							<input id="submit_data" type="submit" class="btn btn-primary btn-sm px-3" value="Save">
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="card table-responsive col-10 px-3 shadow">
				<table class="table table-hover caption-top table-sm">
					<caption class="fw-bold fs-3 text-dark">List of Users</caption>
					<thead class="fw-bold">
						<td class="p-1">ID</td>
						<td class="p-1">Username</td>
						<td class="p-1">First Name</td>
						<td class="p-1">Last Name</td>
						<td class="p-1">E-mail</td>
						<td class="p-1 text-center">Action</td>
					</thead>
					<tbody>
						<?php foreach ($info as $data): ?>
							<tr class="p-3">
								<td class="p-1"><?= $data->id ?></td>
								<td class="p-1"><?= $data->username ?></td>
								<td class="p-1"><?= $data->firstname ?></td>
								<td class="p-1"><?= $data->lastname ?></td>
								<td class="p-1"><?= $data->email ?></td>
								<td class="p-1">
									<div class="d-flex justify-content-center gap-2">
										<button id="edit" data-id="<?= $data->id ?>" data-user="<?= $data->username ?>"
											data-action="Edit" class="btn btn-sm btn-warning">Edit</button>
										<button id="delete" data-id="<?= $data->id ?>"
											class="btn btn-sm btn-danger">Delete</button>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
	var id = 0;
	var action = '';

	$(document).ready(function () {

		$('form').submit(function (e) {
			e.preventDefault();
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
						id: id,
					},
					dataType: "json",
					success: function (data) {
						if (data.error != '') {
							alert(data.error);
						} else {
							alert(data.success);
							location.reload();
						}
					}
				});

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
							alert(data.success);
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

		$(document).on('click', '#delete', function () {
			var id = $(this).data('id');

			$.ajax({
				url: '<?= base_url('welcome/delete_data'); ?>',
				method: 'POST',
				data: {
					id: id,
				},
				dataType: 'json',
				success: function (data) {
					if (data.error != '') {
						alert(data.error);
					} else {
						alert(data.success);
						location.reload();
					}
				}
			});
		});
	});
</script>

</html>