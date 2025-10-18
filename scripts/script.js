$(document).ready(function () {
	loadUsers();
});

async function loadUsers(search = "") {
	try {
		const request = await fetch("scripts/api.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({ action: "getAllUsers", search: search }),
		});

		const response = await request.json();
		if (response.success) {
			let rows = "";
			response.data.forEach((user) => {
				rows += `<tr>
                            <td>${user.user_id}</td>
                            <td>${user.username}</td>
                            <td>${user.first_name}</td>
                            <td>${user.last_name}</td>
                            <td>${user.is_admin ? "True" : "False"}</td>
                            <td>${user.date_added}</td>
                        </tr>`;
			});

			userTableBody.innerHTML = rows;
		} else {
			userTableBody.innerHTML =
				'<tr><td colspan="6">No records found</td></tr>';
		}
	} catch (error) {
		console.error(error);
		userTableBody.innerHTML =
			'<tr><td colspan="6">Error loading data</td></tr>';
	}
}
